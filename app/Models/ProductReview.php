<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'order_id',
        'rating',
        'title',
        'comment',
        'is_approved',
        'is_verified_purchase',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
        'is_verified_purchase' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Check if user has purchased this product
     */
    public static function hasPurchasedProduct($userId, $productId): bool
    {
        return OrderItem::whereHas('order', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                  ->where('status', 'completed');
        })->where('product_id', $productId)->exists();
    }
}
