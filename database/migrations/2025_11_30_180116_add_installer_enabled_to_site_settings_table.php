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
        if (Schema::hasTable('site_settings')) {
            Schema::table('site_settings', function (Blueprint $table) {
                if (!Schema::hasColumn('site_settings', 'installer_enabled')) {
                    $table->boolean('installer_enabled')->default(true)->after('sitemap_change_frequency');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('site_settings')) {
            Schema::table('site_settings', function (Blueprint $table) {
                if (Schema::hasColumn('site_settings', 'installer_enabled')) {
                    $table->dropColumn('installer_enabled');
                }
            });
        }
    }
};
