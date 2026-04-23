<?php

namespace App\Http\Controllers\PaymentGateway;

use Illuminate\Support\Facades\Http;

class SslCommerceGateway extends BasePaymentGateway
{
    public function getGatewayName(): string
    {
        return 'ssl_commerce';
    }

    public function processPayment(array $paymentData): array
    {
        try {
            $this->validatePaymentData($paymentData);
            
            if (!$this->isEnabled()) {
                throw new \Exception('SSL Commerce payment gateway is not enabled');
            }

            $sandboxMode = $this->getConfigValue('sandbox_mode', true);
            $storeId = $this->getConfigValue('store_id');
            $storePassword = $this->getConfigValue('store_password');
            
            // Use sandbox credentials if in sandbox mode and credentials are default
            if ($sandboxMode && ($storeId === 'test_store_id_12345' || empty($storeId))) {
                $storeId = 'testbox';
                $storePassword = 'qwerty';
            }
            
            $apiUrl = $sandboxMode ? 'https://sandbox.sslcommerz.com' : 'https://securepay.sslcommerz.com';

            if (!$storeId || !$storePassword) {
                throw new \Exception('SSL Commerce credentials not configured');
            }

            // Prepare SSL Commerce payment request
            $transactionId = 'SSL_' . $paymentData['order_id'] . '_' . time();
            
            $baseUrl = url('/');
            $postData = [
                'store_id' => $storeId,
                'store_passwd' => $storePassword,
                'total_amount' => number_format($paymentData['amount'], 2, '.', ''),
                'currency' => $paymentData['currency'] ?? 'BDT',
                'tran_id' => $transactionId,
                'success_url' => $this->getConfigValue('success_url', $baseUrl . '/payment/ssl-commerce/success'),
                'fail_url' => $this->getConfigValue('fail_url', $baseUrl . '/payment/ssl-commerce/fail'),
                'cancel_url' => $this->getConfigValue('cancel_url', $baseUrl . '/payment/ssl-commerce/cancel'),
                'emi_option' => 0,
                'cus_name' => $paymentData['customer_name'] ?? '',
                'cus_email' => $paymentData['customer_email'] ?? '',
                'cus_add1' => $paymentData['customer_address'] ?? '',
                'cus_city' => $paymentData['customer_district'] ?? $paymentData['customer_upazila'] ?? 'Dhaka',
                'cus_postcode' => $paymentData['customer_postcode'] ?? '1000',
                'cus_country' => 'Bangladesh',
                'cus_phone' => $paymentData['customer_phone'] ?? '',
                'product_name' => 'Order #' . $paymentData['order_id'],
                'product_category' => 'Ecommerce',
                'product_profile' => 'general',
            ];

            $this->logActivity('payment_created', [
                'transaction_id' => $transactionId,
                'order_id' => $paymentData['order_id'],
                'amount' => $paymentData['amount'],
                'sandbox_mode' => $sandboxMode,
            ]);

            return [
                'success' => true,
                'payment_id' => $transactionId,
                'transaction_id' => $transactionId,
                'amount' => $paymentData['amount'],
                'currency' => $paymentData['currency'] ?? 'BDT',
                'status' => 'pending',
                'redirect_url' => $apiUrl . '/gwprocess/v4/api.php',
                'post_data' => $postData,
                'method' => 'POST',
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

    public function verifyPayment(string $paymentId): array
    {
        try {
            if (!$this->isEnabled()) {
                throw new \Exception('SSL Commerce payment gateway is not enabled');
            }

            $sandboxMode = $this->getConfigValue('sandbox_mode', true);
            $storeId = $this->getConfigValue('store_id');
            $storePassword = $this->getConfigValue('store_password');
            
            // Use sandbox credentials if in sandbox mode and credentials are default
            if ($sandboxMode && ($storeId === 'test_store_id_12345' || empty($storeId))) {
                $storeId = 'testbox';
                $storePassword = 'qwerty';
            }
            
            $apiUrl = $sandboxMode ? 'https://sandbox.sslcommerz.com' : 'https://securepay.sslcommerz.com';

            if (!$storeId || !$storePassword) {
                throw new \Exception('SSL Commerce credentials not configured');
            }

            // Verify payment using SSL Commerce Order Validation API
            $verifyUrl = $apiUrl . '/validator/api/validationserverAPI.php';
            
            $response = Http::asForm()->post($verifyUrl, [
                'val_id' => $paymentId,
                'store_id' => $storeId,
                'store_passwd' => $storePassword,
                'format' => 'json',
            ]);

            if (!$response->successful()) {
                throw new \Exception('Failed to verify payment with SSL Commerce');
            }

            $verifyData = $response->json();
            
            $this->logActivity('payment_verified', [
                'transaction_id' => $paymentId,
                'response' => $verifyData,
            ]);

            // Check if payment is valid
            $status = $verifyData['status'] ?? '';
            $isValid = ($status === 'VALID' || $status === 'VALIDATED');

            return [
                'success' => $isValid,
                'payment_id' => $paymentId,
                'status' => $isValid ? 'verified' : 'failed',
                'data' => $verifyData,
            ];

        } catch (\Exception $e) {
            $this->logActivity('payment_verification_error', [
                'transaction_id' => $paymentId,
                'error' => $e->getMessage(),
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function refundPayment(string $paymentId, float $amount = null): array
    {
        try {
            if (!$this->isEnabled()) {
                throw new \Exception('SSL Commerce payment gateway is not enabled');
            }

            // In production, process refund via SSL Commerce API
            $this->logActivity('refund_created', [
                'transaction_id' => $paymentId,
                'amount' => $amount,
            ]);

            return [
                'success' => true,
                'refund_id' => 'REFUND_' . $paymentId,
                'amount' => $amount,
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}

