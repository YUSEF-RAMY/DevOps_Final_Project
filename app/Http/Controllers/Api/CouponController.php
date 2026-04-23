<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\Cart;
use App\Support\CurrencyManager;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate(['code' => 'required|string|max:255']);
        [$cart] = $this->getOrCreateCart($request);
        $coupon = Coupon::where('code', $request->string('code'))->first();
        if (!$coupon) {
            return response()->json(['message' => 'Invalid coupon code.'], 422);
        }
        if (!$coupon->isValid()) {
            return response()->json(['message' => 'This coupon is no longer valid.'], 422);
        }
        if (!$coupon->canBeUsedBy($cart->user, $cart->session_id)) {
            return response()->json(['message' => 'Usage limit reached for this coupon.'], 422);
        }
        if (!$coupon->appliesToCart($cart)) {
            return response()->json(['message' => 'This coupon cannot be applied to your current cart items.'], 422);
        }
        if (!$cart->applyCoupon($coupon)) {
            return response()->json(['message' => 'Failed to apply coupon.'], 422);
        }
        $cart->refresh();
        return response()->json($this->cartTotals($cart, $coupon));
    }

    public function remove(Request $request)
    {
        [$cart] = $this->getOrCreateCart($request);
        $cart->removeCoupon();
        $cart->refresh();
        return response()->json($this->cartTotals($cart));
    }

    public function validateCode(Request $request)
    {
        $request->validate(['code' => 'required|string|max:255']);
        [$cart] = $this->getOrCreateCart($request);
        $coupon = Coupon::where('code', $request->string('code'))->first();
        if (!$coupon || !$coupon->isValid()) {
            return response()->json(['valid' => false, 'message' => 'Invalid coupon code.']);
        }
        if (!$coupon->canBeUsedBy($cart->user, $cart->session_id)) {
            return response()->json(['valid' => false, 'message' => 'Usage limit reached for this coupon.']);
        }
        if (!$coupon->appliesToCart($cart)) {
            return response()->json(['valid' => false, 'message' => 'Coupon does not apply to this cart.']);
        }
        return response()->json([
            'valid' => true,
            'coupon' => [
                'code' => $coupon->code,
                'name' => $coupon->name,
                'type' => $coupon->type,
                'value' => $coupon->value,
            ],
        ]);
    }

    private function getOrCreateCart(Request $request): array
    {
        $userId = auth()->id();
        $session = (string) $request->header('X-Cart-Session', '');
        if ($userId) {
            $cart = Cart::firstOrCreate(['user_id' => $userId]);
            return [$cart, null];
        }
        if ($session === '') {
            $session = (string) Str::uuid();
        }
        $cart = Cart::firstOrCreate(['session_id' => $session]);
        return [$cart, $session];
    }

    private function money(float $amount): array
    {
        return [
            'amount' => $amount,
            'formatted' => CurrencyManager::format($amount),
        ];
    }

    private function cartTotals(Cart $cart, ?Coupon $coupon = null): array
    {
        return [
            'coupon' => $coupon ? [
                'code' => $coupon->code,
                'name' => $coupon->name,
                'discount' => $this->money((float) $cart->coupon_discount),
            ] : null,
            'totals' => [
                'subtotal' => $this->money((float) $cart->subtotal),
                'discount_total' => $this->money((float) $cart->discount_total),
                'tax_total' => $this->money((float) $cart->tax_total),
                'grand_total' => $this->money((float) $cart->grand_total),
            ],
        ];
    }
}


