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
        // Add SMTP settings to email_settings table
        $smtpSettings = [
            [
                'key' => 'smtp_enabled',
                'name' => 'Enable SMTP',
                'value' => '0',
                'description' => 'Enable SMTP for sending emails',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'smtp_host',
                'name' => 'SMTP Host',
                'value' => '',
                'description' => 'SMTP server hostname (e.g., mail.yourdomain.com, smtp.gmail.com)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'smtp_port',
                'name' => 'SMTP Port',
                'value' => '587',
                'description' => 'SMTP server port (587 for TLS, 465 for SSL, 25 for non-encrypted)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'smtp_username',
                'name' => 'SMTP Username',
                'value' => '',
                'description' => 'SMTP authentication username (usually your email address)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'smtp_password',
                'name' => 'SMTP Password',
                'value' => '',
                'description' => 'SMTP authentication password',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'smtp_encryption',
                'name' => 'SMTP Encryption',
                'value' => 'tls',
                'description' => 'Encryption method (tls, ssl, or none)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'smtp_from_address',
                'name' => 'SMTP From Address',
                'value' => '',
                'description' => 'Email address to send from (must match SMTP username for some providers)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'smtp_from_name',
                'name' => 'SMTP From Name',
                'value' => '',
                'description' => 'Name to display in the "From" field',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($smtpSettings as $setting) {
            // Check if setting already exists
            $exists = DB::table('email_settings')->where('key', $setting['key'])->exists();
            if (!$exists) {
                DB::table('email_settings')->insert($setting);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove SMTP settings
        DB::table('email_settings')->whereIn('key', [
            'smtp_enabled',
            'smtp_host',
            'smtp_port',
            'smtp_username',
            'smtp_password',
            'smtp_encryption',
            'smtp_from_address',
            'smtp_from_name',
        ])->delete();
    }
};
