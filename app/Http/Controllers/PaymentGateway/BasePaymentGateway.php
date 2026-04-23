<?php

namespace App\Http\Controllers\PaymentGateway;

abstract class BasePaymentGateway implements PaymentGatewayInterface
{
    protected $config;
    protected $enabled;

    public function __construct()
    {
        $this->loadConfig();
    }

    /**
     * Load configuration from database
     */
    protected function loadConfig()
    {
        $gatewayName = $this->getGatewayName();
        $settings = \App\Models\PaymentGatewaySetting::where('gateway', $gatewayName)->get();
        
        $this->config = [];
        foreach ($settings as $setting) {
            $value = $setting->value;
            // Convert boolean strings to actual booleans
            if (in_array($setting->key, ['enabled', 'sandbox_mode'])) {
                if (is_bool($value)) {
                    // Already a boolean, keep it
                } elseif (is_string($value)) {
                    $value = in_array(strtolower($value), ['1', 'true', 'yes', 'on']);
                } else {
                    $value = (bool) $value;
                }
            }
            $this->config[$setting->key] = $value;
        }
        
        $this->enabled = $this->config['enabled'] ?? false;
    }

    /**
     * Check if gateway is enabled
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Get gateway configuration
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Get configuration value
     */
    protected function getConfigValue(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }

    /**
     * Log payment activity
     */
    protected function logActivity(string $action, array $data = [])
    {
        \App\Models\PaymentLog::create([
            'gateway' => $this->getGatewayName(),
            'action' => $action,
            'data' => json_encode($data),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Validate payment data
     */
    protected function validatePaymentData(array $data): array
    {
        $required = ['amount', 'currency', 'order_id'];
        $errors = [];

        foreach ($required as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                $errors[] = "Missing required field: {$field}";
            }
        }

        if (!empty($errors)) {
            throw new \InvalidArgumentException(implode(', ', $errors));
        }

        return $data;
    }
}
