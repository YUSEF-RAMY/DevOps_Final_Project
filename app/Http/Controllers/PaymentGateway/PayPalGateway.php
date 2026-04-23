<?php

namespace App\Http\Controllers\PaymentGateway;

class PayPalGateway extends BasePaymentGateway
{
    private $apiUrl;
    private $clientId;
    private $clientSecret;

    public function __construct()
    {
        parent::__construct();
        
        $this->apiUrl = $this->getConfigValue('sandbox_mode') ? 
            'https://api.sandbox.paypal.com' : 
            'https://api.paypal.com';
            
        $this->clientId = $this->getConfigValue('client_id');
        $this->clientSecret = $this->getConfigValue('client_secret');
    }

    /**
     * Get gateway name
     */
    public function getGatewayName(): string
    {
        return 'paypal';
    }

    /**
     * Process payment
     */
    public function processPayment(array $paymentData): array
    {
        try {
            $this->validatePaymentData($paymentData);
            
            if (!$this->isEnabled()) {
                throw new \Exception('PayPal payment gateway is not enabled');
            }

            $accessToken = $this->getAccessToken();
            if (!$accessToken) {
                throw new \Exception('Failed to get PayPal access token');
            }

            $order = $this->createOrder($paymentData, $accessToken);
            
            $this->logActivity('payment_created', [
                'order_id' => $order['id'],
                'order_number' => $paymentData['order_id'],
                'amount' => $paymentData['amount'],
            ]);

            $approvalUrl = $this->getApprovalUrl($order);
            
            return [
                'success' => true,
                'payment_id' => $order['id'],
                'transaction_id' => $order['id'],
                'approval_url' => $approvalUrl,
                'redirect_url' => $approvalUrl, // For consistency
                'amount' => $paymentData['amount'],
                'currency' => $paymentData['currency'],
                'status' => $order['status'],
            ];

        } catch (\Exception $e) {
            $this->logActivity('payment_error', [
                'error' => $e->getMessage(),
                'order_id' => $paymentData['order_id'] ?? null,
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify payment
     */
    public function verifyPayment(string $paymentId): array
    {
        try {
            if (!$this->isEnabled()) {
                throw new \Exception('PayPal payment gateway is not enabled');
            }

            $accessToken = $this->getAccessToken();
            if (!$accessToken) {
                throw new \Exception('Failed to get PayPal access token');
            }

            $order = $this->getOrder($paymentId, $accessToken);

            $this->logActivity('payment_verified', [
                'order_id' => $paymentId,
                'status' => $order['status'],
            ]);

            return [
                'success' => true,
                'payment_id' => $order['id'],
                'status' => $order['status'],
                'amount' => $this->getOrderAmount($order),
                'currency' => $this->getOrderCurrency($order),
                'paid' => $order['status'] === 'COMPLETED',
            ];

        } catch (\Exception $e) {
            $this->logActivity('verification_error', [
                'error' => $e->getMessage(),
                'payment_id' => $paymentId,
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Refund payment
     */
    public function refundPayment(string $paymentId, float $amount = null): array
    {
        try {
            if (!$this->isEnabled()) {
                throw new \Exception('PayPal payment gateway is not enabled');
            }

            $accessToken = $this->getAccessToken();
            if (!$accessToken) {
                throw new \Exception('Failed to get PayPal access token');
            }

            $refund = $this->createRefund($paymentId, $amount, $accessToken);

            $this->logActivity('refund_created', [
                'refund_id' => $refund['id'],
                'order_id' => $paymentId,
                'amount' => $amount,
            ]);

            return [
                'success' => true,
                'refund_id' => $refund['id'],
                'amount' => $refund['amount']['value'],
                'status' => $refund['status'],
            ];

        } catch (\Exception $e) {
            $this->logActivity('refund_error', [
                'error' => $e->getMessage(),
                'payment_id' => $paymentId,
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get access token from PayPal
     */
    private function getAccessToken(): ?string
    {
        $response = $this->makeRequest('POST', '/v1/oauth2/token', [
            'grant_type' => 'client_credentials',
        ], [
            'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        return $response['access_token'] ?? null;
    }

    /**
     * Create PayPal order
     */
    private function createOrder(array $paymentData, string $accessToken): array
    {
        $orderData = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $paymentData['order_id'],
                    'amount' => [
                        'currency_code' => strtoupper($paymentData['currency']),
                        'value' => number_format($paymentData['amount'], 2, '.', ''),
                    ],
                ],
            ],
            'application_context' => [
                'return_url' => url('/payment/paypal/success') . '?order_id=' . $paymentData['order_id'],
                'cancel_url' => url('/payment/paypal/cancel'),
            ],
        ];

        $response = $this->makeRequest('POST', '/v2/checkout/orders', $orderData, [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ]);

        return $response;
    }

    /**
     * Get PayPal order details
     */
    private function getOrder(string $orderId, string $accessToken): array
    {
        $response = $this->makeRequest('GET', "/v2/checkout/orders/{$orderId}", null, [
            'Authorization' => 'Bearer ' . $accessToken,
        ]);

        return $response;
    }

    /**
     * Create refund
     */
    private function createRefund(string $orderId, float $amount, string $accessToken): array
    {
        // Get order to get currency
        $order = $this->getOrder($orderId, $accessToken);
        $currency = $this->getOrderCurrency($order);
        
        $refundData = [
            'amount' => [
                'value' => number_format($amount, 2, '.', ''),
                'currency_code' => $currency ?? 'BDT',
            ],
        ];

        $response = $this->makeRequest('POST', "/v2/payments/captures/{$orderId}/refund", $refundData, [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ]);

        return $response;
    }

    /**
     * Get approval URL from order
     */
    private function getApprovalUrl(array $order): string
    {
        foreach ($order['links'] as $link) {
            if ($link['rel'] === 'approve') {
                return $link['href'];
            }
        }
        return '';
    }

    /**
     * Get order amount
     */
    private function getOrderAmount(array $order): float
    {
        return (float) $order['purchase_units'][0]['amount']['value'];
    }

    /**
     * Get order currency
     */
    private function getOrderCurrency(array $order): string
    {
        return $order['purchase_units'][0]['amount']['currency_code'];
    }

    /**
     * Make HTTP request to PayPal API
     */
    private function makeRequest(string $method, string $endpoint, array $data = null, array $headers = []): array
    {
        $url = $this->apiUrl . $endpoint;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->formatHeaders($headers));
        
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            }
        }
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode >= 400) {
            throw new \Exception("PayPal API error: HTTP {$httpCode}");
        }
        
        return json_decode($response, true) ?? [];
    }

    /**
     * Format headers for cURL
     */
    private function formatHeaders(array $headers): array
    {
        $formatted = [];
        foreach ($headers as $key => $value) {
            $formatted[] = "{$key}: {$value}";
        }
        return $formatted;
    }
}
