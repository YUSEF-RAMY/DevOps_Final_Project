<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    /**
     * Apply coupon to cart
     */
    public function apply(Request $request)
    {
        try {
            $request->validate([
                'code' => 'required|string|max:255',
            ]);

            $code = trim($request->input('code', ''));
            if (empty($code)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter a coupon code.'
                ], 422);
            }

            $coupon = Coupon::where('code', $code)->first();

            if (!$coupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid coupon code.'
                ], 422);
            }

            // Get current cart
            $cart = $this->getCurrentCart($request);

            if (!$cart) {
                return response()->json([
                    'success' => false,
                    'message' => 'No cart found. Please add items to your cart first.'
                ], 422);
            }

            if (!$coupon->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This coupon is no longer valid.'
                ], 422);
            }

            if (!$coupon->canBeUsedBy($cart->user, $cart->session_id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have reached the usage limit for this coupon.'
                ], 422);
            }

            if (!$coupon->appliesToCart($cart)) {
                if ($coupon->minimum_amount && $cart->subtotal < $coupon->minimum_amount) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Minimum order amount of $' . number_format($coupon->minimum_amount, 2) . ' required for this coupon.'
                    ], 422);
                }
                
                return response()->json([
                    'success' => false,
                    'message' => 'This coupon cannot be applied to your current cart items.'
                ], 422);
            }

            if ($cart->applyCoupon($coupon)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Coupon applied successfully!',
                    'coupon' => [
                        'code' => $coupon->code,
                        'name' => $coupon->name,
                        'discount' => $coupon->calculateDiscount($cart->subtotal),
                        'type' => $coupon->type,
                        'value' => $coupon->value,
                    ],
                    'cart' => [
                        'subtotal' => $cart->subtotal,
                        'discount_total' => $cart->discount_total,
                        'tax_total' => $cart->tax_total,
                        'grand_total' => $cart->grand_total,
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to apply coupon.'
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Coupon application error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while applying the coupon.'
            ], 500);
        }
    }

    /**
     * Remove coupon from cart
     */
    public function remove(Request $request)
    {
        try {
            $cart = $this->getCurrentCart($request);
            
            if (!$cart) {
                return redirect()->back()->with('error', 'No cart found.');
            }
            
            if ($cart->coupon) {
                $cart->removeCoupon();
                return redirect()->back()->with('success', 'Coupon removed successfully!');
            }

            return redirect()->back()->with('error', 'No coupon applied to remove.');
        } catch (\Exception $e) {
            \Log::error('Coupon removal error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while removing the coupon.');
        }
    }

    /**
     * Validate coupon code
     */
    public function validateCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid coupon code.'
            ]);
        }

        $cart = $this->getCurrentCart($request);

        if (!$coupon->isValid()) {
            return response()->json([
                'valid' => false,
                'message' => 'This coupon is no longer valid.'
            ]);
        }

        if (!$coupon->canBeUsedBy($cart->user, $cart->session_id)) {
            return response()->json([
                'valid' => false,
                'message' => 'You have reached the usage limit for this coupon.'
            ]);
        }

        if (!$coupon->appliesToCart($cart)) {
            if ($coupon->minimum_amount && $cart->subtotal < $coupon->minimum_amount) {
                return response()->json([
                    'valid' => false,
                    'message' => 'Minimum order amount of $' . number_format($coupon->minimum_amount, 2) . ' required for this coupon.'
                ]);
            }
            
            return response()->json([
                'valid' => false,
                'message' => 'This coupon cannot be applied to your current cart items.'
            ]);
        }

        $discount = $coupon->calculateDiscount($cart->subtotal);

        return response()->json([
            'valid' => true,
            'message' => 'Coupon is valid!',
            'coupon' => [
                'code' => $coupon->code,
                'name' => $coupon->name,
                'description' => $coupon->description,
                'discount' => $discount,
                'type' => $coupon->type,
                'value' => $coupon->value,
            ]
        ]);
    }

    /**
     * Get current cart
     */
    private function getCurrentCart(Request $request): ?Cart
    {
        try {
            $sessionId = $request->session()->get('cart_session_id');
            
            if (!$sessionId) {
                $sessionId = (string) \Illuminate\Support\Str::uuid();
                $request->session()->put('cart_session_id', $sessionId);
            }
            
            // If user is authenticated, try to find their cart first
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->with('items')->first();
                if ($cart) {
                    return $cart;
                }
            }
            
            // Otherwise, use session-based cart
            $cart = Cart::with('items')->firstOrCreate([
                'session_id' => $sessionId,
            ], [
                'user_id' => Auth::id(),
                'subtotal' => 0,
                'discount_total' => 0,
                'tax_total' => 0,
                'grand_total' => 0,
                'coupon_discount' => 0,
            ]);
            
            return $cart;
        } catch (\Exception $e) {
            \Log::error('Error in getCurrentCart: ' . $e->getMessage());
            return null;
        }
    }
}