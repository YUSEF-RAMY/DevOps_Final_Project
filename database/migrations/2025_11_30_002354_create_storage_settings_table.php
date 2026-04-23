<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('storage_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->text('value')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default storage settings
        $defaultSettings = [
            [
                'key' => 'storage_driver',
                'name' => 'Storage Driver',
                'value' => 'local',
                'description' => 'Storage driver: local, s3, cloudflare, digitalocean, wasabi, backblaze, etc.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // AWS S3 Settings
            [
                'key' => 's3_key',
                'name' => 'AWS Access Key ID',
                'value' => '',
                'description' => 'AWS S3 Access Key ID',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 's3_secret',
                'name' => 'AWS Secret Access Key',
                'value' => '',
                'description' => 'AWS S3 Secret Access Key',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 's3_region',
                'name' => 'AWS Region',
                'value' => 'us-east-1',
                'description' => 'AWS S3 Region (e.g., us-east-1, ap-southeast-1)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 's3_bucket',
                'name' => 'S3 Bucket Name',
                'value' => '',
                'description' => 'AWS S3 Bucket Name',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 's3_url',
                'name' => 'S3 URL',
                'value' => '',
                'description' => 'S3 URL (optional, auto-generated if empty)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 's3_endpoint',
                'name' => 'S3 Endpoint',
                'value' => '',
                'description' => 'S3 Endpoint (for S3-compatible services like DigitalOcean, Wasabi, etc.)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 's3_use_path_style',
                'name' => 'Use Path Style',
                'value' => '0',
                'description' => 'Use path-style endpoint (required for some S3-compatible services)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Cloudflare R2 Settings
            [
                'key' => 'cloudflare_account_id',
                'name' => 'Cloudflare Account ID',
                'value' => '',
                'description' => 'Cloudflare Account ID',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'cloudflare_access_key_id',
                'name' => 'Cloudflare Access Key ID',
                'value' => '',
                'description' => 'Cloudflare R2 Access Key ID',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'cloudflare_secret_access_key',
                'name' => 'Cloudflare Secret Access Key',
                'value' => '',
                'description' => 'Cloudflare R2 Secret Access Key',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'cloudflare_bucket',
                'name' => 'Cloudflare R2 Bucket',
                'value' => '',
                'description' => 'Cloudflare R2 Bucket Name',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'cloudflare_endpoint',
                'name' => 'Cloudflare R2 Endpoint',
                'value' => '',
                'description' => 'Cloudflare R2 Endpoint URL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // DigitalOcean Spaces Settings
            [
                'key' => 'digitalocean_key',
                'name' => 'DigitalOcean Spaces Key',
                'value' => '',
                'description' => 'DigitalOcean Spaces Access Key',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'digitalocean_secret',
                'name' => 'DigitalOcean Spaces Secret',
                'value' => '',
                'description' => 'DigitalOcean Spaces Secret Key',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'digitalocean_region',
                'name' => 'DigitalOcean Region',
                'value' => 'nyc3',
                'description' => 'DigitalOcean Spaces Region (e.g., nyc3, sgp1)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'digitalocean_bucket',
                'name' => 'DigitalOcean Spaces Bucket',
                'value' => '',
                'description' => 'DigitalOcean Spaces Bucket Name',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'digitalocean_endpoint',
                'name' => 'DigitalOcean Endpoint',
                'value' => '',
                'description' => 'DigitalOcean Spaces Endpoint (auto-generated if empty)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Wasabi Settings
            [
                'key' => 'wasabi_key',
                'name' => 'Wasabi Access Key',
                'value' => '',
                'description' => 'Wasabi Access Key',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'wasabi_secret',
                'name' => 'Wasabi Secret Key',
                'value' => '',
                'description' => 'Wasabi Secret Key',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'wasabi_region',
                'name' => 'Wasabi Region',
                'value' => 'us-east-1',
                'description' => 'Wasabi Region',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'wasabi_bucket',
                'name' => 'Wasabi Bucket',
                'value' => '',
                'description' => 'Wasabi Bucket Name',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'wasabi_endpoint',
                'name' => 'Wasabi Endpoint',
                'value' => '',
                'description' => 'Wasabi Endpoint URL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Backblaze B2 Settings
            [
                'key' => 'backblaze_key_id',
                'name' => 'Backblaze Key ID',
                'value' => '',
                'description' => 'Backblaze B2 Application Key ID',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'backblaze_application_key',
                'name' => 'Backblaze Application Key',
                'value' => '',
                'description' => 'Backblaze B2 Application Key',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'backblaze_bucket_id',
                'name' => 'Backblaze Bucket ID',
                'value' => '',
                'description' => 'Backblaze B2 Bucket ID',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'backblaze_bucket_name',
                'name' => 'Backblaze Bucket Name',
                'value' => '',
                'description' => 'Backblaze B2 Bucket Name',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // CDN Settings
            [
                'key' => 'cdn_enabled',
                'name' => 'Enable CDN',
                'value' => '0',
                'description' => 'Enable CDN for serving static files',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'cdn_url',
                'name' => 'CDN URL',
                'value' => '',
                'description' => 'CDN URL (e.g., https://cdn.yourdomain.com or Cloudflare CDN URL)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('storage_settings')->insert($defaultSettings);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_settings');
    }
};
