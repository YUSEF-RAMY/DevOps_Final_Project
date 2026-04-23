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
        Schema::table('otp_settings', function (Blueprint $table) {
            $table->string('sms_package')->nullable()->after('sms_gateway');
            $table->boolean('sandbox_mode')->default(false)->after('sms_package');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('otp_settings', function (Blueprint $table) {
            $table->dropColumn(['sms_package', 'sandbox_mode']);
        });
    }
};
