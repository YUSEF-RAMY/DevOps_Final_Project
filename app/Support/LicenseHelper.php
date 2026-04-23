<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class LicenseHelper
{
    /**
     * License validation server URL (change this to your server)
     */
    private static $licenseServer = 'https://your-license-server.com/api/validate';
    
    /**
     * Valid license keys (add your license keys here)
     */
    private static $validLicenseKeys = [
        'pub-2069693345597629', // Your license key
    ];

    /**
     * Check if license is valid
     */
    public static function isValid(): bool
    {
        // Get license key from database
        $licenseKey = self::getLicenseKey();
        
        // If no license key is set, return false
        if (empty($licenseKey)) {
            return false;
        }

        // Check cache first (validate every 24 hours)
        $cacheKey = 'license_valid_' . md5($licenseKey);
        $cached = Cache::get($cacheKey);
        
        if ($cached !== null) {
            return (bool) $cached;
        }

        // Validate with license server
        $isValid = self::validateWithServer($licenseKey);
        
        // Cache result for 24 hours
        Cache::put($cacheKey, $isValid, now()->addHours(24));
        
        return $isValid;
    }

    /**
     * Get license key from database
     */
    public static function getLicenseKey(): string
    {
        try {
            if (!\Schema::hasTable('site_settings')) {
                return '';
            }
            
            $settings = \App\Models\SiteSetting::first();
            return $settings->license_key ?? '';
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Validate license with remote server or local validation
     */
    private static function validateWithServer(string $licenseKey): bool
    {
        // First check if it's a valid local license key
        if (in_array($licenseKey, self::$validLicenseKeys)) {
            return true;
        }

        // If not in local list, try remote validation
        try {
            $domain = request()->getHost();
            $serverInfo = [
                'domain' => $domain,
                'ip' => request()->ip(),
                'server_name' => $_SERVER['SERVER_NAME'] ?? '',
            ];

            $response = Http::timeout(10)->post(self::$licenseServer, [
                'license_key' => $licenseKey,
                'domain' => $domain,
                'server_info' => $serverInfo,
                'app_version' => config('app.version', '1.0.0'),
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return isset($data['valid']) && $data['valid'] === true;
            }

            return false;
        } catch (\Exception $e) {
            // If server is unreachable, check if it's a valid local key
            if (in_array($licenseKey, self::$validLicenseKeys)) {
                return true;
            }
            // Otherwise, allow offline mode for limited time
            return self::checkOfflineMode();
        }
    }

    /**
     * Check offline mode (grace period)
     */
    private static function checkOfflineMode(): bool
    {
        $lastValidation = Cache::get('license_last_validation');
        
        if ($lastValidation) {
            // Allow 7 days offline grace period
            $gracePeriod = now()->subDays(7);
            if ($lastValidation->isAfter($gracePeriod)) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Activate license
     */
    public static function activate(string $licenseKey, string $domain = null): array
    {
        // Check if it's a valid local license key first
        if (in_array($licenseKey, self::$validLicenseKeys)) {
            // Save license key to database
            self::saveLicenseKey($licenseKey);
            
            // Clear cache
            Cache::forget('license_valid_' . md5($licenseKey));
            Cache::put('license_last_validation', now());
            
            return [
                'success' => true,
                'message' => 'License activated successfully!',
            ];
        }

        // If not in local list, try remote activation
        try {
            $domain = $domain ?? request()->getHost();
            
            $response = Http::timeout(10)->post(self::$licenseServer . '/activate', [
                'license_key' => $licenseKey,
                'domain' => $domain,
                'server_info' => [
                    'ip' => request()->ip(),
                    'server_name' => $_SERVER['SERVER_NAME'] ?? '',
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['valid']) && $data['valid'] === true) {
                    // Save license key to database
                    self::saveLicenseKey($licenseKey);
                    
                    // Clear cache
                    Cache::forget('license_valid_' . md5($licenseKey));
                    Cache::put('license_last_validation', now());
                    
                    return [
                        'success' => true,
                        'message' => 'License activated successfully!',
                    ];
                }
            }

            return [
                'success' => false,
                'message' => $response->json()['message'] ?? 'Invalid license key',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Unable to connect to license server. Please check your internet connection.',
            ];
        }
    }

    /**
     * Save license key to database
     */
    private static function saveLicenseKey(string $licenseKey): void
    {
        try {
            if (\Schema::hasTable('site_settings')) {
                $settings = \App\Models\SiteSetting::first();
                if ($settings) {
                    $settings->license_key = $licenseKey;
                    $settings->save();
                }
            }
        } catch (\Exception $e) {
            // Ignore
        }
    }

    /**
     * Get license information
     */
    public static function getLicenseInfo(): array
    {
        $licenseKey = self::getLicenseKey();
        
        return [
            'key' => $licenseKey ? substr($licenseKey, 0, 8) . '...' . substr($licenseKey, -4) : null,
            'is_valid' => self::isValid(),
            'last_validation' => Cache::get('license_last_validation'),
        ];
    }

    /**
     * Remove/clear license key
     */
    public static function remove(): array
    {
        try {
            if (!\Schema::hasTable('site_settings')) {
                return [
                    'success' => false,
                    'message' => 'Database table not found.',
                ];
            }
            
            $settings = \App\Models\SiteSetting::first();
            if ($settings) {
                $oldKey = $settings->license_key;
                $settings->license_key = null;
                $settings->save();
                
                // Clear all license-related cache
                if ($oldKey) {
                    Cache::forget('license_valid_' . md5($oldKey));
                }
                Cache::forget('license_last_validation');
                
                return [
                    'success' => true,
                    'message' => 'License key has been removed successfully.',
                ];
            }
            
            return [
                'success' => false,
                'message' => 'Settings not found.',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to remove license: ' . $e->getMessage(),
            ];
        }
    }
}

