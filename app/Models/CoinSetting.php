<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinSetting extends Model
{
    protected $fillable = [
        'coins_enabled','add_to_cart_enabled','order_award_enabled','cod_bonus_enabled','referral_enabled',
        'add_to_cart_award','add_to_cart_daily_cap','order_rate_per','order_rate_coins','order_min_award','cod_bonus','referral_signup_bonus'
    ];

    public static function get(): self
    {
        return static::first() ?? static::create([]);
    }
}


