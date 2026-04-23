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
            $table->boolean('reviews_enabled')->default(true)->after('wishlist_enabled');
            $table->boolean('reviews_require_purchase')->default(false)->after('reviews_enabled');
            $table->boolean('reviews_require_approval')->default(true)->after('reviews_require_purchase');
            $table->boolean('reviews_allow_anonymous')->default(false)->after('reviews_require_approval');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'reviews_enabled',
                'reviews_require_purchase',
                'reviews_require_approval',
                'reviews_allow_anonymous'
            ]);
        });
    }
};
