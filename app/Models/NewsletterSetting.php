<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsletterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'enabled', 'double_opt_in', 'send_welcome_email', 'provider', 'provider_config'
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'double_opt_in' => 'boolean',
        'send_welcome_email' => 'boolean',
        'provider_config' => 'array',
    ];

    public static function get(): self
    {
        return static::first() ?? static::create([]);
    }
}
