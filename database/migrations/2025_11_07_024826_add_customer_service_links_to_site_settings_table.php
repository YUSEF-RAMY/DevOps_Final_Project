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
            $table->string('help_center_url')->nullable()->after('cookies_url');
            $table->string('shipping_info_url')->nullable()->after('help_center_url');
            $table->string('returns_url')->nullable()->after('shipping_info_url');
            $table->string('contact_us_url')->nullable()->after('returns_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'help_center_url',
                'shipping_info_url',
                'returns_url',
                'contact_us_url'
            ]);
        });
    }
};
