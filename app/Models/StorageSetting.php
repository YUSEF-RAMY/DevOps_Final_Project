<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageSetting extends Model
{
    protected $fillable = [
        'key',
        'name',
        'value',
        'description',
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    public static function isEnabled($key)
    {
        return static::get($key, '0') === '1';
    }
}
