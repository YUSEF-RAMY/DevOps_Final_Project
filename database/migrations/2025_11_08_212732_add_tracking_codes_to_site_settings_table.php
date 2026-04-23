<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->text('google_analytics_code')->nullable()->after('sitemap_change_frequency');
            $table->text('facebook_pixel_code')->nullable()->after('google_analytics_code');
            $table->text('microsoft_clarity_code')->nullable()->after('facebook_pixel_code');
            $table->text('custom_head_code')->nullable()->after('microsoft_clarity_code');
            $table->text('custom_body_code')->nullable()->after('custom_head_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'google_analytics_code',
                'facebook_pixel_code',
                'microsoft_clarity_code',
                'custom_head_code',
                'custom_body_code'
            ]);
        });
    }
};
