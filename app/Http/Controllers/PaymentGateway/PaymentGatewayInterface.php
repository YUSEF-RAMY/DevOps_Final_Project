<?php

namespace App\Http\Controllers\PaymentGateway;

interface PaymentGatewayInterface
{
    /**
     * Process payment
     */
    public function processPayment(array $paymentData): array;

    /**
     * Verify payment
     */
    public function verifyPayment(string $paymentId): array;

    /**
     * Refund payment
     */
    public function refundPayment(string $paymentId, float $amount = null): array;

    /**
     * Get gateway name
     */
    public function getGatewayName(): string;

    /**
     * Check if gateway is enabled
     */
    public function isEnabled(): bool;

    /**
     * Get gateway configuration
     */
    public function getConfig(): array;
}
