<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtpSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_enabled','sms_enabled','length','ttl_minutes','max_attempts','sms_gateway','sms_package','sandbox_mode','sms_masking',
        'sms_api_url','sms_api_key','sms_username','sms_password','sms_sender'
    ];

    protected $casts = [
        'email_enabled' => 'boolean',
        'sms_enabled' => 'boolean',
        'sandbox_mode' => 'boolean',
        'length' => 'integer',
        'ttl_minutes' => 'integer',
        'max_attempts' => 'integer',
    ];

    public static function get(): self
    {
        return static::first() ?? static::create([]);
    }
}
