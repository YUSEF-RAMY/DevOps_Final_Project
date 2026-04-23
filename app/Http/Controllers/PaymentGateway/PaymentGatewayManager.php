<?php

namespace App\Http\Controllers\PaymentGateway;

class PaymentGatewayManager
{
    private $gateways = [];

    public function __construct()
    {
        $this->registerGateways();
    }

    /**
     * Register available payment gateways
     */
    private function registerGateways()
    {
        $this->gateways = [
            // Bangladeshi payment gateways
            'bkash' => BkashGateway::class,
            'nagad' => NagadGateway::class,
            'rocket' => RocketGateway::class,
            'ssl_commerce' => SslCommerceGateway::class,
            'cod' => null, // COD doesn't need a gateway class, handled separately
            // International gateways (optional)
            'stripe' => StripeGateway::class,
            'paypal' => PayPalGateway::class,
        ];
    }

    /**
     * Get payment gateway instance
     */
    public function getGateway(string $name): ?PaymentGatewayInterface
    {
        if ($name === 'cod') {
            return null; // COD doesn't have a gateway class
        }
        
        if (!isset($this->gateways[$name])) {
            return null;
        }

        $gatewayClass = $this->gateways[$name];
        return new $gatewayClass();
    }

    /**
     * Get all available gateways
     */
    public function getAllGateways(): array
    {
        $availableGateways = [];
        
        foreach ($this->gateways as $name => $class) {
            if ($name === 'cod') {
                // Handle COD separately
                $codEnabled = \App\Models\PaymentGatewaySetting::where('gateway', 'cod')
                    ->where('key', 'enabled')
                    ->value('value');
                $availableGateways[$name] = [
                    'name' => $name,
                    'display_name' => 'Cash on Delivery',
                    'enabled' => (bool) ($codEnabled ?? true), // Default to enabled
                    'config' => [],
                ];
            } else {
                $displayNames = [
                    'bkash' => 'bKash',
                    'nagad' => 'Nagad',
                    'rocket' => 'Rocket',
                    'ssl_commerce' => 'SSL Commerce',
                    'stripe' => 'Stripe',
                    'paypal' => 'PayPal',
                ];
                $gateway = new $class();
                $config = $gateway->getConfig();
                $availableGateways[$name] = [
                    'name' => $name,
                    'display_name' => $displayNames[$name] ?? ucfirst(str_replace('_', ' ', $name)),
                    'enabled' => $gateway->isEnabled(),
                    'config' => $config,
                ];
            }
        }
        
        return $availableGateways;
    }

    /**
     * Get enabled gateways only
     */
    public function getEnabledGateways(): array
    {
        $enabledGateways = [];
        
        foreach ($this->gateways as $name => $class) {
            if ($name === 'cod') {
                // Check COD enabled status
                $codEnabled = \App\Models\PaymentGatewaySetting::where('gateway', 'cod')
                    ->where('key', 'enabled')
                    ->value('value');
                if ((bool) ($codEnabled ?? true)) {
                    $enabledGateways[$name] = [
                        'name' => $name,
                        'display_name' => 'Cash on Delivery',
                        'config' => [],
                    ];
                }
            } else {
                $displayNames = [
                    'bkash' => 'bKash',
                    'nagad' => 'Nagad',
                    'rocket' => 'Rocket',
                    'ssl_commerce' => 'SSL Commerce',
                    'stripe' => 'Stripe',
                    'paypal' => 'PayPal',
                ];
                $gateway = new $class();
                if ($gateway->isEnabled()) {
                    $enabledGateways[$name] = [
                        'name' => $name,
                        'display_name' => $displayNames[$name] ?? ucfirst(str_replace('_', ' ', $name)),
                        'config' => $gateway->getConfig(),
                    ];
                }
            }
        }
        
        return $enabledGateways;
    }

    /**
     * Check if gateway exists
     */
    public function hasGateway(string $name): bool
    {
        return isset($this->gateways[$name]);
    }

    /**
     * Get gateway names
     */
    public function getGatewayNames(): array
    {
        return array_keys($this->gateways);
    }
}
