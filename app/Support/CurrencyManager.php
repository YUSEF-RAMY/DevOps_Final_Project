<?php

namespace App\Support;

use App\Models\Currency;

class CurrencyManager
{
    const SESSION_KEY = 'currency_code';

    public static function current(): Currency
    {
        // Always use the default currency globally
        return Currency::default() ?: Currency::firstOrFail();
    }

    public static function set(string $code): bool
    {
        // Only allow admin to set currency for the application session
        if (!auth('admin')->check()) {
            return false;
        }
        $currency = Currency::where('code', strtoupper($code))->where('is_active', true)->first();
        if (!$currency) {
            return false;
        }
        session([self::SESSION_KEY => $currency->code]);
        return true;
    }

    public static function format(float $amount, ?Currency $currency = null): string
    {
        $c = $currency ?: self::current();
        // Use BDT formatting defaults: 2 decimal places, comma separator, symbol before
        $formatted = number_format($amount, 2, '.', ',');
        return $c->symbol . $formatted;
    }

    /**
     * Convert a base amount to the current currency numeric value (no symbol, no formatting).
     */
    public static function convert(float $amount, ?Currency $currency = null, ?int $precisionOverride = null): float
    {
        $c = $currency ?: self::current();
        $precision = $precisionOverride ?? 2;
        return round($amount, $precision);
    }

    /**
     * Get the default currency (alias for current() for backward compatibility)
     */
    public static function getDefaultCurrency(): ?Currency
    {
        return Currency::default();
    }
}
