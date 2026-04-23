<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'user_id',
        'status',
        'subtotal',
        'discount_total',
        'tax_total',
        'shipping_total',
        'grand_total',
        'currency',
        'payment_method',
        'payment_status',
        'payment_transaction_id',
        'payment_transaction_details',
        'shipping_method',
        'shipping_status',
        'shipping_courier',
        'shipping_tracking_number',
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_address',
        'billing_postcode',
        'billing_country',
        'billing_division',
        'billing_district',
        'billing_upazila',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_postcode',
        'shipping_country',
        'shipping_division',
        'shipping_district',
        'shipping_upazila',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount_total' => 'decimal:2',
        'tax_total' => 'decimal:2',
        'shipping_total' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
