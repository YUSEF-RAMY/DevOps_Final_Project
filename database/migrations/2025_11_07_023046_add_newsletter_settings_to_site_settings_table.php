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
            $table->boolean('newsletter_enabled')->default(true)->after('reviews_allow_anonymous');
            $table->boolean('newsletter_double_opt_in')->default(true)->after('newsletter_enabled');
            $table->boolean('newsletter_send_welcome_email')->default(true)->after('newsletter_double_opt_in');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'newsletter_enabled',
                'newsletter_double_opt_in',
                'newsletter_send_welcome_email'
            ]);
        });
    }
};
