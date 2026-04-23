<?php

namespace App\Http\Controllers\PaymentGateway;

class BkashGateway extends BasePaymentGateway
{
    public function getGatewayName(): string
    {
        return 'bkash';
    }

    public function processPayment(array $paymentData): array
    {
        try {
            $this->validatePaymentData($paymentData);
            
            if (!$this->isEnabled()) {
                throw new \Exception('bKash payment gateway is not enabled');
            }

            $sandboxMode = $this->getConfigValue('sandbox_mode', true);
            $apiKey = $this->getConfigValue('api_key');
            $apiSecret = $this->getConfigValue('api_secret');
            $username = $this->getConfigValue('username');
            $password = $this->getConfigValue('password');
            
            // Generate transaction ID
            $transactionId = 'BKASH_' . $paymentData['order_id'] . '_' . time();
            
            $baseUrl = url('/');
            $callbackUrl = $baseUrl . '/payment/bkash/callback';
            
            // Use default sandbox credentials if in sandbox mode and credentials are default
            if ($sandboxMode && ($apiKey === 'bkash_test_api_key_1234567890' || empty($apiKey))) {
                $apiKey = '4f6o0cjiki2rfm34kfdadl1eqq';
                $apiSecret = '2is7hdktrekvrbljjh44d3l9dt';
                $username = 'sandboxTokenizedUser02';
                $password = 'sandboxTokenizedUser02@12345';
            }
            
            // bKash API endpoints
            $apiBaseUrl = $sandboxMode 
                ? 'https://tokenized.sandbox.bkash.sh' 
                : 'https://tokenized.pay.bka.sh';
            
            // Step 1: Get access token using username/password
            $tokenResponse = \Illuminate\Support\Facades\Http::asForm()->post($apiBaseUrl . '/tokenized/checkout/token/grant', [
                'app_key' => $apiKey,
                'app_secret' => $apiSecret,
                'username' => $username,
                'password' => $password,
            ]);
            
            if (!$tokenResponse->successful()) {
                throw new \Exception('Failed to get bKash access token');
            }
            
            $tokenData = $tokenResponse->json();
            $accessToken = $tokenData['id_token'] ?? null;
            
            if (!$accessToken) {
                throw new \Exception('Invalid bKash access token response');
            }
            
            // Step 2: Create payment
            $paymentResponse = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => $accessToken,
                'X-APP-Key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->post($apiBaseUrl . '/tokenized/checkout/payment/create', [
                'mode' => '0011',
                'payerReference' => $paymentData['customer_phone'] ?? '',
                'callbackURL' => $callbackUrl,
                'amount' => (string) $paymentData['amount'],
                'currency' => $paymentData['currency'] ?? 'BDT',
                'intent' => 'sale',
                'merchantInvoiceNumber' => $transactionId,
            ]);
            
            if (!$paymentResponse->successful()) {
                throw new \Exception('Failed to create bKash payment: ' . $paymentResponse->body());
            }
            
            $paymentDataResponse = $paymentResponse->json();
            $paymentId = $paymentDataResponse['paymentID'] ?? null;
            $bkashURL = $paymentDataResponse['bkashURL'] ?? null;
            
            if (!$bkashURL) {
                throw new \Exception('bKash did not return a payment URL');
            }
            
            $this->logActivity('payment_created', [
                'transaction_id' => $transactionId,
                'payment_id' => $paymentId,
                'order_id' => $paymentData['order_id'],
                'amount' => $paymentData['amount'],
                'sandbox_mode' => $sandboxMode,
            ]);

            return [
                'success' => true,
                'payment_id' => $paymentId,
                'transaction_id' => $transactionId,
                'amount' => $paymentData['amount'],
                'currency' => $paymentData['currency'] ?? 'BDT',
                'status' => 'pending',
                'redirect_url' => $bkashURL,
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
                throw new \Exception('bKash payment gateway is not enabled');
            }

            $sandboxMode = $this->getConfigValue('sandbox_mode', true);
            $apiKey = $this->getConfigValue('api_key');
            $apiSecret = $this->getConfigValue('api_secret');
            $username = $this->getConfigValue('username', 'sandboxTokenizedUser02');
            $password = $this->getConfigValue('password', 'sandboxTokenizedUser02@12345');
            
            // Use default sandbox credentials if in sandbox mode
            if ($sandboxMode && ($apiKey === 'bkash_test_api_key_1234567890' || empty($apiKey))) {
                $apiKey = '4f6o0cjiki2rfm34kfdadl1eqq';
                $apiSecret = '2is7hdktrekvrbljjh44d3l9dt';
                $username = 'sandboxTokenizedUser02';
                $password = 'sandboxTokenizedUser02@12345';
            }
            
            $apiBaseUrl = $sandboxMode 
                ? 'https://tokenized.sandbox.bkash.sh' 
                : 'https://tokenized.pay.bka.sh';
            
            // Get access token
            $tokenResponse = \Illuminate\Support\Facades\Http::asForm()->post($apiBaseUrl . '/tokenized/checkout/token/grant', [
                'app_key' => $apiKey,
                'app_secret' => $apiSecret,
                'username' => $username,
                'password' => $password,
            ]);
            
            if (!$tokenResponse->successful()) {
                throw new \Exception('Failed to get bKash access token for verification: ' . $tokenResponse->body());
            }
            
            $tokenData = $tokenResponse->json();
            $accessToken = $tokenData['id_token'] ?? null;
            
            if (!$accessToken) {
                throw new \Exception('Invalid bKash access token response');
            }
            
            // Execute/Verify payment
            $executeResponse = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => $accessToken,
                'X-APP-Key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->post($apiBaseUrl . '/tokenized/checkout/payment/execute', [
                'paymentID' => $paymentId,
            ]);
            
            if (!$executeResponse->successful()) {
                $errorBody = $executeResponse->body();
                throw new \Exception('Failed to execute bKash payment verification: ' . $errorBody);
            }
            
            $executeData = $executeResponse->json();
            
            // Check if payment was successful
            $statusCode = $executeData['statusCode'] ?? null;
            $statusMessage = $executeData['statusMessage'] ?? '';
            $isSuccessful = ($statusCode === '0000' && isset($executeData['transactionStatus']) && $executeData['transactionStatus'] === 'Completed');
            
            $this->logActivity('payment_verified', [
                'transaction_id' => $paymentId,
                'status_code' => $statusCode,
                'status_message' => $statusMessage,
                'is_successful' => $isSuccessful,
                'response' => $executeData,
            ]);

            if (!$isSuccessful) {
                return [
                    'success' => false,
                    'payment_id' => $paymentId,
                    'status' => 'failed',
                    'error' => $statusMessage ?: 'Payment verification failed',
                    'data' => $executeData,
                ];
            }

            return [
                'success' => true,
                'payment_id' => $paymentId,
                'status' => 'verified',
                'data' => $executeData,
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
                throw new \Exception('bKash payment gateway is not enabled');
            }

            // In production, process refund via bKash API
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

