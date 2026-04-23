<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentGateway\PaymentGatewayManager;
use App\Models\PaymentGatewaySetting;
use App\Models\PaymentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentGatewayController extends Controller
{
    private $gatewayManager;

    public function __construct(PaymentGatewayManager $gatewayManager)
    {
        $this->gatewayManager = $gatewayManager;
    }

    /**
     * Display payment gateway settings
     */
    public function index()
    {
        $gateways = $this->gatewayManager->getAllGateways();
        
        // Get recent payment logs, ensuring we always have a collection
        try {
            $recentLogs = PaymentLog::getRecentLogs(20);
        } catch (\Exception $e) {
            // If there's an error (e.g., table doesn't exist), use empty collection
            $recentLogs = collect([]);
        }
        
        return view('admin.payment-gateways.index', compact('gateways', 'recentLogs'));
    }

    /**
     * Show settings for a specific gateway
     */
    public function show(string $gateway)
    {
        if ($gateway === 'cod') {
            // Handle COD separately
            $settings = PaymentGatewaySetting::where('gateway', 'cod')->get();
            return view('admin.payment-gateways.show-cod', compact('settings'));
        }
        
        if (!$this->gatewayManager->hasGateway($gateway)) {
            return redirect()->route('admin.payment-gateways.index')
                ->with('error', 'Invalid payment gateway.');
        }

        $gatewayInstance = $this->gatewayManager->getGateway($gateway);
        $settings = PaymentGatewaySetting::where('gateway', $gateway)->get();
        $logs = PaymentLog::getGatewayLogs($gateway, 50);

        return view('admin.payment-gateways.show', compact('gateway', 'gatewayInstance', 'settings', 'logs'));
    }

    /**
     * Update gateway settings
     */
    public function update(Request $request, string $gateway)
    {
        if ($gateway === 'cod') {
            // Handle COD update
            $enabled = $request->boolean('enabled', true);
            PaymentGatewaySetting::setGatewaySetting(
                'cod',
                'enabled',
                $enabled,
                'Enable or disable Cash on Delivery payment method'
            );
            return redirect()->route('admin.payment-gateways.show', 'cod')
                ->with('success', 'Cash on Delivery settings updated successfully.');
        }
        
        if (!$this->gatewayManager->hasGateway($gateway)) {
            return redirect()->route('admin.payment-gateways.index')
                ->with('error', 'Invalid payment gateway.');
        }

        $gatewayInstance = $this->gatewayManager->getGateway($gateway);
        
        // Define validation rules based on gateway
        $rules = $this->getValidationRules($gateway);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update settings
            foreach ($request->all() as $key => $value) {
                if ($key !== '_token' && $key !== '_method') {
                    // Convert checkbox values to boolean
                    if (in_array($key, ['enabled', 'sandbox_mode'])) {
                        $value = $value == '1' || $value === true || $value === 'true' ? true : false;
                    }
                    
                    $isEncrypted = $this->isEncryptedField($gateway, $key);
                    PaymentGatewaySetting::setGatewaySetting(
                        $gateway,
                        $key,
                        $value,
                        $this->getFieldDescription($gateway, $key),
                        $isEncrypted
                    );
                }
            }

            return redirect()->route('admin.payment-gateways.show', $gateway)
                ->with('success', 'Payment gateway settings updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update settings: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Toggle gateway enabled status
     */
    public function toggleStatus(string $gateway)
    {
        if ($gateway === 'cod') {
            $currentStatus = (bool) PaymentGatewaySetting::where('gateway', 'cod')
                ->where('key', 'enabled')
                ->value('value') ?? true;
            $newStatus = !$currentStatus;
            
            PaymentGatewaySetting::setGatewaySetting(
                'cod',
                'enabled',
                $newStatus,
                'Enable or disable Cash on Delivery payment method'
            );
            
            $statusText = $newStatus ? 'enabled' : 'disabled';
            return redirect()->back()
                ->with('success', "Cash on Delivery has been {$statusText}.");
        }
        
        if (!$this->gatewayManager->hasGateway($gateway)) {
            return redirect()->route('admin.payment-gateways.index')
                ->with('error', 'Invalid payment gateway.');
        }

        $gatewayInstance = $this->gatewayManager->getGateway($gateway);
        $currentStatus = $gatewayInstance->isEnabled();
        $newStatus = !$currentStatus;

        PaymentGatewaySetting::setGatewaySetting(
            $gateway,
            'enabled',
            $newStatus,
            'Enable or disable this payment gateway'
        );

        $statusText = $newStatus ? 'enabled' : 'disabled';
        
        return redirect()->back()
            ->with('success', ucfirst($gateway) . " payment gateway has been {$statusText}.");
    }

    /**
     * Test gateway connection
     */
    public function testConnection(string $gateway)
    {
        if (!$this->gatewayManager->hasGateway($gateway)) {
            return response()->json(['success' => false, 'message' => 'Invalid payment gateway.']);
        }

        try {
            $gatewayInstance = $this->gatewayManager->getGateway($gateway);
            
            if (!$gatewayInstance->isEnabled()) {
                return response()->json(['success' => false, 'message' => 'Gateway is not enabled.']);
            }

            // Test with dummy data
            $testData = [
                'amount' => 1.00,
                'currency' => 'BDT',
                'order_id' => 'test_' . time(),
                'customer_email' => 'test@example.com',
                'customer_phone' => '01700000000',
            ];

            $result = $gatewayInstance->processPayment($testData);
            
            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Connection test successful!',
                    'details' => $result
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Connection test failed: ' . ($result['error'] ?? 'Unknown error')
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection test failed: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get validation rules for gateway
     */
    private function getValidationRules(string $gateway): array
    {
        $rules = [];

        switch ($gateway) {
            case 'bkash':
                $rules = [
                    'enabled' => 'boolean',
                    'api_key' => 'nullable|string|max:255',
                    'api_secret' => 'nullable|string|max:255',
                    'username' => 'nullable|string|max:255',
                    'password' => 'nullable|string|max:255',
                    'sandbox_mode' => 'boolean',
                ];
                break;
            case 'nagad':
            case 'rocket':
                $rules = [
                    'enabled' => 'boolean',
                    'merchant_number' => 'nullable|string|max:20',
                    'api_key' => 'nullable|string|max:255',
                    'api_secret' => 'nullable|string|max:255',
                    'sandbox_mode' => 'boolean',
                ];
                break;

            case 'ssl_commerce':
                $rules = [
                    'enabled' => 'boolean',
                    'store_id' => 'required_if:enabled,true|string|max:255',
                    'store_password' => 'required_if:enabled,true|string|max:255',
                    'api_url' => 'nullable|url|max:255',
                    'success_url' => 'nullable|url|max:255',
                    'fail_url' => 'nullable|url|max:255',
                    'cancel_url' => 'nullable|url|max:255',
                    'sandbox_mode' => 'boolean',
                ];
                break;

            case 'stripe':
                $rules = [
                    'enabled' => 'boolean',
                    'publishable_key' => 'required_if:enabled,true|string|max:255',
                    'secret_key' => 'required_if:enabled,true|string|max:255',
                    'webhook_secret' => 'nullable|string|max:255',
                    'sandbox_mode' => 'boolean',
                ];
                break;

            case 'paypal':
                $rules = [
                    'enabled' => 'boolean',
                    'client_id' => 'required_if:enabled,true|string|max:255',
                    'client_secret' => 'required_if:enabled,true|string|max:255',
                    'sandbox_mode' => 'boolean',
                ];
                break;
        }

        return $rules;
    }

    /**
     * Check if field should be encrypted
     */
    private function isEncryptedField(string $gateway, string $field): bool
    {
        $encryptedFields = [
            'bkash' => ['api_secret', 'password'],
            'nagad' => ['api_secret'],
            'rocket' => ['api_secret'],
            'ssl_commerce' => ['store_password'],
            'stripe' => ['secret_key', 'webhook_secret'],
            'paypal' => ['client_secret'],
        ];

        return in_array($field, $encryptedFields[$gateway] ?? []);
    }

    /**
     * Get field description
     */
    private function getFieldDescription(string $gateway, string $field): string
    {
        $descriptions = [
            'bkash' => [
                'enabled' => 'Enable or disable bKash payment gateway',
                'api_key' => 'bKash App Key (from bKash merchant panel)',
                'api_secret' => 'bKash App Secret (from bKash merchant panel)',
                'username' => 'bKash Username (for tokenized checkout)',
                'password' => 'bKash Password (for tokenized checkout)',
                'sandbox_mode' => 'Use bKash sandbox for testing',
            ],
            'nagad' => [
                'enabled' => 'Enable or disable Nagad payment gateway',
                'merchant_number' => 'Nagad merchant account number',
                'api_key' => 'Nagad API key',
                'api_secret' => 'Nagad API secret',
                'sandbox_mode' => 'Use Nagad sandbox for testing',
            ],
            'rocket' => [
                'enabled' => 'Enable or disable Rocket payment gateway',
                'merchant_number' => 'Rocket merchant account number',
                'api_key' => 'Rocket API key',
                'api_secret' => 'Rocket API secret',
                'sandbox_mode' => 'Use Rocket sandbox for testing',
            ],
            'ssl_commerce' => [
                'enabled' => 'Enable or disable SSL Commerce payment gateway',
                'store_id' => 'SSL Commerce store ID',
                'store_password' => 'SSL Commerce store password',
                'api_url' => 'SSL Commerce API URL (default: sandbox.sslcommerz.com)',
                'success_url' => 'URL to redirect after successful payment',
                'fail_url' => 'URL to redirect after failed payment',
                'cancel_url' => 'URL to redirect after cancelled payment',
                'sandbox_mode' => 'Use SSL Commerce sandbox for testing',
            ],
            'stripe' => [
                'enabled' => 'Enable or disable Stripe payment gateway',
                'publishable_key' => 'Stripe publishable key (starts with pk_)',
                'secret_key' => 'Stripe secret key (starts with sk_)',
                'webhook_secret' => 'Stripe webhook endpoint secret',
                'sandbox_mode' => 'Use Stripe test mode for testing',
            ],
            'paypal' => [
                'enabled' => 'Enable or disable PayPal payment gateway',
                'client_id' => 'PayPal application client ID',
                'client_secret' => 'PayPal application client secret',
                'sandbox_mode' => 'Use PayPal sandbox for testing',
            ],
        ];

        return $descriptions[$gateway][$field] ?? ucfirst(str_replace('_', ' ', $field));
    }
}