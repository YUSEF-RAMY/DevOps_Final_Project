<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingSetting extends Model
{
    protected $fillable = [
        'enabled',
        'flat_rate',
        'free_shipping_enabled',
        'free_shipping_min_total',
        'division_rates',
        'district_rates',
        'tax_enabled',
        'tax_type',
        'tax_rate'
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'flat_rate' => 'decimal:2',
        'free_shipping_enabled' => 'boolean',
        'free_shipping_min_total' => 'decimal:2',
        'division_rates' => 'array',
        'district_rates' => 'array',
        'tax_enabled' => 'boolean',
        'tax_rate' => 'decimal:2',
    ];

    public static function get(): self
    {
        $setting = static::first();
        if (!$setting) {
            $setting = static::create([
                'enabled' => true,
                'flat_rate' => 0,
                'free_shipping_enabled' => true,
                'free_shipping_min_total' => 0,
                'tax_enabled' => false,
                'tax_type' => 'percent',
                'tax_rate' => 0,
                'division_rates' => [],
                'district_rates' => [],
            ]);
        }
        
        return $setting;
    }
}


