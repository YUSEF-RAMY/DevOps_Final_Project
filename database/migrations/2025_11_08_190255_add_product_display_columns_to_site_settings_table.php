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
            $table->tinyInteger('product_display_columns_mobile')->default(2)->after('social_linkedin');
            $table->tinyInteger('product_display_columns_desktop')->default(3)->after('product_display_columns_mobile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['product_display_columns_mobile', 'product_display_columns_desktop']);
        });
    }
};
