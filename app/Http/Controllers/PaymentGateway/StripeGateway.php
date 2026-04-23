<?php

namespace App\Http\Controllers\PaymentGateway;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use Stripe\Refund;
use Stripe\Exception\ApiErrorException;

class StripeGateway extends BasePaymentGateway
{
    public function __construct()
    {
        parent::__construct();
        
        if ($this->isEnabled()) {
            $secretKey = $this->getConfigValue('secret_key');
            if ($secretKey) {
                Stripe::setApiKey($secretKey);
            }
        }
    }

    /**
     * Get gateway name
     */
    public function getGatewayName(): string
    {
        return 'stripe';
    }

    /**
     * Process payment
     */
    public function processPayment(array $paymentData): array
    {
        try {
            $this->validatePaymentData($paymentData);
            
            if (!$this->isEnabled()) {
                throw new \Exception('Stripe payment gateway is not enabled');
            }

            $sandboxMode = $this->getConfigValue('sandbox_mode', true);
            $baseUrl = url('/');
            
            // Create Stripe Checkout Session
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => strtolower($paymentData['currency'] ?? 'bdt'),
                        'product_data' => [
                            'name' => 'Order #' . $paymentData['order_id'],
                        ],
                        'unit_amount' => $this->convertToCents($paymentData['amount']),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $baseUrl . '/payment/stripe/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $baseUrl . '/payment/stripe/cancel',
                'metadata' => [
                    'order_id' => $paymentData['order_id'],
                ],
                'customer_email' => $paymentData['customer_email'] ?? null,
            ]);

            $this->logActivity('payment_created', [
                'session_id' => $session->id,
                'order_id' => $paymentData['order_id'],
                'amount' => $paymentData['amount'],
                'sandbox_mode' => $sandboxMode,
            ]);
            
            return [
                'success' => true,
                'payment_id' => $session->id,
                'transaction_id' => $session->id,
                'redirect_url' => $session->url,
                'amount' => $paymentData['amount'],
                'currency' => $paymentData['currency'],
                'status' => 'pending',
            ];

        } catch (ApiErrorException $e) {
            $this->logActivity('payment_error', [
                'error' => $e->getMessage(),
                'order_id' => $paymentData['order_id'] ?? null,
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
                'error_code' => $e->getStripeCode(),
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
                throw new \Exception('Stripe payment gateway is not enabled');
            }

            // Retrieve Checkout Session (since we're using Checkout Sessions)
            $session = Session::retrieve($paymentId);

            $this->logActivity('payment_verified', [
                'session_id' => $paymentId,
                'payment_status' => $session->payment_status,
                'status' => $session->status,
            ]);

            return [
                'success' => true,
                'payment_id' => $session->id,
                'status' => $session->status,
                'payment_status' => $session->payment_status,
                'amount' => $session->amount_total ? $this->convertFromCents($session->amount_total) : 0,
                'currency' => strtoupper($session->currency ?? 'usd'),
                'paid' => $session->payment_status === 'paid',
            ];

        } catch (ApiErrorException $e) {
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
                throw new \Exception('Stripe payment gateway is not enabled');
            }

            $refundData = ['payment_intent' => $paymentId];
            
            if ($amount !== null) {
                $refundData['amount'] = $this->convertToCents($amount);
            }

            $refund = Refund::create($refundData);

            $this->logActivity('refund_created', [
                'refund_id' => $refund->id,
                'payment_intent_id' => $paymentId,
                'amount' => $amount,
            ]);

            return [
                'success' => true,
                'refund_id' => $refund->id,
                'amount' => $this->convertFromCents($refund->amount),
                'status' => $refund->status,
            ];

        } catch (ApiErrorException $e) {
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
     * Convert amount to cents (Stripe uses cents)
     */
    private function convertToCents(float $amount): int
    {
        return (int) round($amount * 100);
    }

    /**
     * Convert amount from cents
     */
    private function convertFromCents(int $amount): float
    {
        return $amount / 100;
    }

    /**
     * Get webhook signature verification
     */
    public function verifyWebhook(string $payload, string $signature): bool
    {
        $endpointSecret = $this->getConfigValue('webhook_secret');
        
        if (!$endpointSecret) {
            return false;
        }

        try {
            \Stripe\Webhook::constructEvent($payload, $signature, $endpointSecret);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
