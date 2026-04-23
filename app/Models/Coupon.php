<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'value',
        'minimum_amount',
        'maximum_discount',
        'usage_limit',
        'usage_limit_per_user',
        'starts_at',
        'expires_at',
        'is_active',
        'applicable_categories',
        'applicable_products',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
        'starts_at' => 'date',
        'expires_at' => 'date',
        'is_active' => 'boolean',
        'applicable_categories' => 'array',
        'applicable_products' => 'array',
    ];

    public function usages(): HasMany
    {
        return $this->hasMany(CouponUsage::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'coupon_usages');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'coupon_usages');
    }

    /**
     * Check if coupon is valid
     */
    public function isValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = Carbon::now();
        
        if ($this->starts_at && $now->lt($this->starts_at)) {
            return false;
        }

        if ($this->expires_at && $now->gt($this->expires_at)) {
            return false;
        }

        if ($this->usage_limit && $this->usages()->count() >= $this->usage_limit) {
            return false;
        }

        return true;
    }

    /**
     * Check if coupon can be used by user
     */
    public function canBeUsedBy(?User $user, ?string $sessionId = null): bool
    {
        if (!$this->isValid()) {
            return false;
        }

        if ($this->usage_limit_per_user) {
            $usageCount = $this->usages()
                ->where(function ($query) use ($user, $sessionId) {
                    if ($user) {
                        $query->where('user_id', $user->id);
                    } else {
                        $query->where('session_id', $sessionId);
                    }
                })
                ->count();

            if ($usageCount >= $this->usage_limit_per_user) {
                return false;
            }
        }

        return true;
    }

    /**
     * Calculate discount amount
     */
    public function calculateDiscount(float $subtotal): float
    {
        if ($this->type === 'percentage') {
            $discount = ($subtotal * $this->value) / 100;
            
            if ($this->maximum_discount && $discount > $this->maximum_discount) {
                $discount = $this->maximum_discount;
            }
            
            return round($discount, 2);
        } else {
            return min($this->value, $subtotal);
        }
    }

    /**
     * Check if coupon applies to cart items
     */
    public function appliesToCart(Cart $cart): bool
    {
        if ($this->minimum_amount && $cart->subtotal < $this->minimum_amount) {
            return false;
        }

        // Check if coupon applies to specific categories
        if ($this->applicable_categories) {
            $cartCategoryIds = $cart->items->pluck('product.category_id')->unique()->toArray();
            if (!array_intersect($this->applicable_categories, $cartCategoryIds)) {
                return false;
            }
        }

        // Check if coupon applies to specific products
        if ($this->applicable_products) {
            $cartProductIds = $cart->items->pluck('product_id')->toArray();
            if (!array_intersect($this->applicable_products, $cartProductIds)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Scope for active coupons
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function ($q) {
                        $q->whereNull('starts_at')
                          ->orWhere('starts_at', '<=', now());
                    })
                    ->where(function ($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>=', now());
                    });
    }

    /**
     * Scope for valid coupons
     */
    public function scopeValid($query)
    {
        return $query->active()
                    ->where(function ($q) {
                        $q->whereNull('usage_limit')
                          ->orWhereRaw('usage_limit > (SELECT COUNT(*) FROM coupon_usages WHERE coupon_id = coupons.id)');
                    });
    }
}