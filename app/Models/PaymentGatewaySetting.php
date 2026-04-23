<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentGatewaySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'gateway',
        'key',
        'value',
        'description',
        'is_encrypted',
    ];

    protected $casts = [
        'is_encrypted' => 'boolean',
    ];

    /**
     * Get setting value (decrypt if needed)
     */
    public function getValueAttribute($value)
    {
        if ($this->is_encrypted) {
            if ($value === null || $value === '') {
                return $value;
            }
            try {
                return decrypt($value);
            } catch (\Throwable $e) {
                // Return raw value if it's not a valid encrypted payload
                return $value;
            }
        }
        return $value;
    }

    /**
     * Set setting value (encrypt if needed)
     */
    public function setValueAttribute($value)
    {
        if ($this->is_encrypted) {
            if ($value === null || $value === '') {
                $this->attributes['value'] = $value;
                return;
            }
            $this->attributes['value'] = encrypt($value);
        } else {
            $this->attributes['value'] = $value;
        }
    }

    /**
     * Get settings for a specific gateway
     */
    public static function getGatewaySettings(string $gateway): array
    {
        $settings = self::where('gateway', $gateway)->get();
        $result = [];
        
        foreach ($settings as $setting) {
            $result[$setting->key] = $setting->value;
        }
        
        return $result;
    }

    /**
     * Set setting for a gateway
     */
    public static function setGatewaySetting(string $gateway, string $key, $value, string $description = null, bool $isEncrypted = false): void
    {
        self::updateOrCreate(
            ['gateway' => $gateway, 'key' => $key],
            [
                'value' => $value,
                'description' => $description,
                'is_encrypted' => $isEncrypted,
            ]
        );
    }
}
