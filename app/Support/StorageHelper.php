<?php

namespace App\Support;

use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * Get URL for a file, using CDN if enabled
     */
    public static function url($path, $disk = null)
    {
        // If CDN is enabled, prepend CDN URL
        if (StorageSetting::isEnabled('cdn_enabled')) {
            $cdnUrl = StorageSetting::get('cdn_url');
            if ($cdnUrl) {
                return rtrim($cdnUrl, '/') . '/' . ltrim($path, '/');
            }
        }

        // Use Storage facade if disk is specified
        if ($disk) {
            return Storage::disk($disk)->url($path);
        }

        // Fallback to asset() helper
        return asset($path);
    }

    /**
     * Get the current storage disk
     */
    public static function getDisk()
    {
        $driver = StorageSetting::get('storage_driver', 'local');
        
        if ($driver === 'local') {
            return 'public';
        }

        return $driver;
    }

    /**
     * Store a file using the configured storage driver
     */
    public static function store($file, $path = '', $disk = null)
    {
        $disk = $disk ?? self::getDisk();
        return Storage::disk($disk)->put($path, $file);
    }

    /**
     * Delete a file from storage
     */
    public static function delete($path, $disk = null)
    {
        $disk = $disk ?? self::getDisk();
        return Storage::disk($disk)->delete($path);
    }
}

