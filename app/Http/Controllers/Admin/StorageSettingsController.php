<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StorageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class StorageSettingsController extends Controller
{
    public function index()
    {
        $settings = StorageSetting::all();
        
        // Get current storage driver
        $currentDriver = StorageSetting::get('storage_driver', 'local');
        
        // Get settings grouped by provider
        $storageSettings = [
            'driver' => StorageSetting::get('storage_driver', 'local'),
            's3' => [
                'key' => StorageSetting::get('s3_key', ''),
                'secret' => StorageSetting::get('s3_secret', ''),
                'region' => StorageSetting::get('s3_region', 'us-east-1'),
                'bucket' => StorageSetting::get('s3_bucket', ''),
                'url' => StorageSetting::get('s3_url', ''),
                'endpoint' => StorageSetting::get('s3_endpoint', ''),
                'use_path_style' => StorageSetting::isEnabled('s3_use_path_style'),
            ],
            'cloudflare' => [
                'account_id' => StorageSetting::get('cloudflare_account_id', ''),
                'access_key_id' => StorageSetting::get('cloudflare_access_key_id', ''),
                'secret_access_key' => StorageSetting::get('cloudflare_secret_access_key', ''),
                'bucket' => StorageSetting::get('cloudflare_bucket', ''),
                'endpoint' => StorageSetting::get('cloudflare_endpoint', ''),
            ],
            'digitalocean' => [
                'key' => StorageSetting::get('digitalocean_key', ''),
                'secret' => StorageSetting::get('digitalocean_secret', ''),
                'region' => StorageSetting::get('digitalocean_region', 'nyc3'),
                'bucket' => StorageSetting::get('digitalocean_bucket', ''),
                'endpoint' => StorageSetting::get('digitalocean_endpoint', ''),
            ],
            'wasabi' => [
                'key' => StorageSetting::get('wasabi_key', ''),
                'secret' => StorageSetting::get('wasabi_secret', ''),
                'region' => StorageSetting::get('wasabi_region', 'us-east-1'),
                'bucket' => StorageSetting::get('wasabi_bucket', ''),
                'endpoint' => StorageSetting::get('wasabi_endpoint', ''),
            ],
            'backblaze' => [
                'key_id' => StorageSetting::get('backblaze_key_id', ''),
                'application_key' => StorageSetting::get('backblaze_application_key', ''),
                'bucket_id' => StorageSetting::get('backblaze_bucket_id', ''),
                'bucket_name' => StorageSetting::get('backblaze_bucket_name', ''),
            ],
            'cdn' => [
                'enabled' => StorageSetting::isEnabled('cdn_enabled'),
                'url' => StorageSetting::get('cdn_url', ''),
            ],
        ];
        
        return view('admin.storage-settings.index', compact('settings', 'storageSettings', 'currentDriver'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'storage_driver' => 'required|in:local,s3,cloudflare,digitalocean,wasabi,backblaze',
            's3_key' => 'nullable|string',
            's3_secret' => 'nullable|string',
            's3_region' => 'nullable|string',
            's3_bucket' => 'nullable|string',
            's3_url' => 'nullable|url',
            's3_endpoint' => 'nullable|url',
            's3_use_path_style' => 'nullable|boolean',
            'cloudflare_account_id' => 'nullable|string',
            'cloudflare_access_key_id' => 'nullable|string',
            'cloudflare_secret_access_key' => 'nullable|string',
            'cloudflare_bucket' => 'nullable|string',
            'cloudflare_endpoint' => 'nullable|url',
            'digitalocean_key' => 'nullable|string',
            'digitalocean_secret' => 'nullable|string',
            'digitalocean_region' => 'nullable|string',
            'digitalocean_bucket' => 'nullable|string',
            'digitalocean_endpoint' => 'nullable|url',
            'wasabi_key' => 'nullable|string',
            'wasabi_secret' => 'nullable|string',
            'wasabi_region' => 'nullable|string',
            'wasabi_bucket' => 'nullable|string',
            'wasabi_endpoint' => 'nullable|url',
            'backblaze_key_id' => 'nullable|string',
            'backblaze_application_key' => 'nullable|string',
            'backblaze_bucket_id' => 'nullable|string',
            'backblaze_bucket_name' => 'nullable|string',
            'cdn_enabled' => 'nullable|boolean',
            'cdn_url' => 'nullable|url',
        ]);

        // Update storage driver
        StorageSetting::set('storage_driver', $request->input('storage_driver', 'local'));

        // Update S3 settings
        StorageSetting::set('s3_key', $request->input('s3_key', ''));
        StorageSetting::set('s3_secret', $request->input('s3_secret', ''));
        StorageSetting::set('s3_region', $request->input('s3_region', 'us-east-1'));
        StorageSetting::set('s3_bucket', $request->input('s3_bucket', ''));
        StorageSetting::set('s3_url', $request->input('s3_url', ''));
        StorageSetting::set('s3_endpoint', $request->input('s3_endpoint', ''));
        StorageSetting::set('s3_use_path_style', $request->boolean('s3_use_path_style') ? '1' : '0');

        // Update Cloudflare settings
        StorageSetting::set('cloudflare_account_id', $request->input('cloudflare_account_id', ''));
        StorageSetting::set('cloudflare_access_key_id', $request->input('cloudflare_access_key_id', ''));
        StorageSetting::set('cloudflare_secret_access_key', $request->input('cloudflare_secret_access_key', ''));
        StorageSetting::set('cloudflare_bucket', $request->input('cloudflare_bucket', ''));
        StorageSetting::set('cloudflare_endpoint', $request->input('cloudflare_endpoint', ''));

        // Update DigitalOcean settings
        StorageSetting::set('digitalocean_key', $request->input('digitalocean_key', ''));
        StorageSetting::set('digitalocean_secret', $request->input('digitalocean_secret', ''));
        StorageSetting::set('digitalocean_region', $request->input('digitalocean_region', 'nyc3'));
        StorageSetting::set('digitalocean_bucket', $request->input('digitalocean_bucket', ''));
        StorageSetting::set('digitalocean_endpoint', $request->input('digitalocean_endpoint', ''));

        // Update Wasabi settings
        StorageSetting::set('wasabi_key', $request->input('wasabi_key', ''));
        StorageSetting::set('wasabi_secret', $request->input('wasabi_secret', ''));
        StorageSetting::set('wasabi_region', $request->input('wasabi_region', 'us-east-1'));
        StorageSetting::set('wasabi_bucket', $request->input('wasabi_bucket', ''));
        StorageSetting::set('wasabi_endpoint', $request->input('wasabi_endpoint', ''));

        // Update Backblaze settings
        StorageSetting::set('backblaze_key_id', $request->input('backblaze_key_id', ''));
        StorageSetting::set('backblaze_application_key', $request->input('backblaze_application_key', ''));
        StorageSetting::set('backblaze_bucket_id', $request->input('backblaze_bucket_id', ''));
        StorageSetting::set('backblaze_bucket_name', $request->input('backblaze_bucket_name', ''));

        // Update CDN settings
        StorageSetting::set('cdn_enabled', $request->boolean('cdn_enabled') ? '1' : '0');
        StorageSetting::set('cdn_url', $request->input('cdn_url', ''));

        // Update filesystem configuration
        $this->updateFilesystemConfig();

        // Clear config cache to ensure new settings are applied
        \Artisan::call('config:clear');

        return redirect()->route('admin.storage-settings.index')
            ->with('success', 'Storage settings updated successfully!');
    }

    private function updateFilesystemConfig()
    {
        $driver = StorageSetting::get('storage_driver', 'local');
        
        if ($driver === 'local') {
            Config::set('filesystems.default', 'local');
            return;
        }

        // Configure based on selected driver
        switch ($driver) {
            case 's3':
                Config::set('filesystems.default', 's3');
                Config::set('filesystems.disks.s3', [
                    'driver' => 's3',
                    'key' => StorageSetting::get('s3_key'),
                    'secret' => StorageSetting::get('s3_secret'),
                    'region' => StorageSetting::get('s3_region', 'us-east-1'),
                    'bucket' => StorageSetting::get('s3_bucket'),
                    'url' => StorageSetting::get('s3_url'),
                    'endpoint' => StorageSetting::get('s3_endpoint'),
                    'use_path_style_endpoint' => StorageSetting::isEnabled('s3_use_path_style'),
                ]);
                break;

            case 'cloudflare':
                // Cloudflare R2 is S3-compatible
                Config::set('filesystems.default', 'cloudflare');
                Config::set('filesystems.disks.cloudflare', [
                    'driver' => 's3',
                    'key' => StorageSetting::get('cloudflare_access_key_id'),
                    'secret' => StorageSetting::get('cloudflare_secret_access_key'),
                    'region' => 'auto',
                    'bucket' => StorageSetting::get('cloudflare_bucket'),
                    'endpoint' => StorageSetting::get('cloudflare_endpoint') ?: 'https://' . StorageSetting::get('cloudflare_account_id') . '.r2.cloudflarestorage.com',
                    'use_path_style_endpoint' => false,
                ]);
                break;

            case 'digitalocean':
                Config::set('filesystems.default', 'digitalocean');
                Config::set('filesystems.disks.digitalocean', [
                    'driver' => 's3',
                    'key' => StorageSetting::get('digitalocean_key'),
                    'secret' => StorageSetting::get('digitalocean_secret'),
                    'region' => StorageSetting::get('digitalocean_region', 'nyc3'),
                    'bucket' => StorageSetting::get('digitalocean_bucket'),
                    'endpoint' => StorageSetting::get('digitalocean_endpoint') ?: 'https://' . StorageSetting::get('digitalocean_region', 'nyc3') . '.digitaloceanspaces.com',
                    'use_path_style_endpoint' => false,
                ]);
                break;

            case 'wasabi':
                Config::set('filesystems.default', 'wasabi');
                Config::set('filesystems.disks.wasabi', [
                    'driver' => 's3',
                    'key' => StorageSetting::get('wasabi_key'),
                    'secret' => StorageSetting::get('wasabi_secret'),
                    'region' => StorageSetting::get('wasabi_region', 'us-east-1'),
                    'bucket' => StorageSetting::get('wasabi_bucket'),
                    'endpoint' => StorageSetting::get('wasabi_endpoint') ?: 'https://s3.' . StorageSetting::get('wasabi_region', 'us-east-1') . '.wasabisys.com',
                    'use_path_style_endpoint' => false,
                ]);
                break;

            case 'backblaze':
                // Backblaze B2 is S3-compatible
                Config::set('filesystems.default', 'backblaze');
                Config::set('filesystems.disks.backblaze', [
                    'driver' => 's3',
                    'key' => StorageSetting::get('backblaze_key_id'),
                    'secret' => StorageSetting::get('backblaze_application_key'),
                    'region' => 'us-west-004',
                    'bucket' => StorageSetting::get('backblaze_bucket_name'),
                    'endpoint' => 'https://s3.us-west-004.backblazeb2.com',
                    'use_path_style_endpoint' => true,
                ]);
                break;
        }
    }
}
