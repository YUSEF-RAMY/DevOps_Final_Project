<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\User;

class CouponPreviewController extends Controller
{
    public function preview(Request $request)
    {
        $data = $request->validate([
            'code' => ['required','string','max:255'],
            'subtotal' => ['required','numeric','min:0'],
            'user_id' => ['nullable','integer','exists:users,id'],
            'user_identifier' => ['nullable','string','max:191'],
            'product_ids' => ['nullable','array'],
            'product_ids.*' => ['integer'],
        ]);

        $coupon = Coupon::where('code', $data['code'])->first();
        if(!$coupon) return response()->json(['valid'=>false,'message'=>'Invalid coupon code.'], 200);

        if (!$coupon->isValid()) {
            return response()->json(['valid'=>false,'message'=>'This coupon is no longer valid.']);
        }

        $user = null;
        if(!empty($data['user_id'])){
            $user = User::find($data['user_id']);
        } elseif (!empty($data['user_identifier'])) {
            $uid = $data['user_identifier'];
            $user = User::where('id', $uid)
                ->orWhere('email', $uid)
                ->orWhere('phone', $uid)
                ->first();
        }
        if (!$coupon->canBeUsedBy($user, null)) {
            return response()->json(['valid'=>false,'message'=>'Usage limit reached for this coupon.']);
        }

        // Check minimum amount
        $subtotal = (float) $data['subtotal'];
        if ($coupon->minimum_amount && $subtotal < (float) $coupon->minimum_amount) {
            return response()->json(['valid'=>false,'message'=>'Minimum order amount of $'.number_format($coupon->minimum_amount,2).' required.']);
        }

        // If coupon has applicable products/categories, do a simple product id check when provided
        if ($coupon->applicable_products && is_array($coupon->applicable_products)) {
            $ids = collect($data['product_ids'] ?? [])->map(fn($v)=>(int)$v)->filter()->values()->all();
            if (empty($ids) || !array_intersect($coupon->applicable_products, $ids)) {
                return response()->json(['valid'=>false,'message'=>'Coupon does not apply to selected products.']);
            }
        }

        $discount = $coupon->calculateDiscount($subtotal);
        return response()->json([
            'valid' => true,
            'discount' => $discount,
            'type' => $coupon->type,
            'value' => (float) $coupon->value,
            'message' => 'Coupon applied',
        ]);
    }
}


