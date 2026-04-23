<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'session_id',
        'subtotal',
        'discount_total',
        'tax_total',
        'grand_total',
        'coupon_id',
        'coupon_discount',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount_total' => 'decimal:2',
        'tax_total' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'coupon_discount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * Apply coupon to cart
     */
    public function applyCoupon(Coupon $coupon): bool
    {
        if (!$coupon->isValid()) {
            return false;
        }

        if (!$coupon->canBeUsedBy($this->user, $this->session_id)) {
            return false;
        }

        if (!$coupon->appliesToCart($this)) {
            return false;
        }

        $this->coupon_id = $coupon->id;
        $this->coupon_discount = $coupon->calculateDiscount($this->subtotal);
        $this->save();

        $this->recalculateTotals();
        return true;
    }

    /**
     * Remove coupon from cart
     */
    public function removeCoupon(): void
    {
        $this->coupon_id = null;
        $this->coupon_discount = 0;
        $this->save();

        $this->recalculateTotals();
    }

    /**
     * Recalculate cart totals
     */
    public function recalculateTotals(): void
    {
        $this->load('items');
        $this->subtotal = $this->items->sum('line_total');
        $this->discount_total = $this->coupon_discount;
        
        // Calculate tax based on shipping settings
        $shippingSettings = \App\Models\ShippingSetting::get();
        $taxableAmount = $this->subtotal - $this->discount_total;
        
        if ($shippingSettings->tax_enabled && $shippingSettings->tax_rate > 0) {
            if ($shippingSettings->tax_type === 'percent') {
                $this->tax_total = round($taxableAmount * ($shippingSettings->tax_rate / 100), 2);
            } else {
                $this->tax_total = round((float) $shippingSettings->tax_rate, 2);
            }
        } else {
            $this->tax_total = 0;
        }
        
        $this->grand_total = $this->subtotal - $this->discount_total + $this->tax_total;
        $this->save();
    }
}
