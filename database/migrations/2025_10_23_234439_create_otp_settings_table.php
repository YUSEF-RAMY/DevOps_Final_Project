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
        Schema::create('otp_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('email_enabled')->default(true);
            $table->boolean('sms_enabled')->default(false);
            $table->unsignedTinyInteger('length')->default(6);
            $table->unsignedTinyInteger('ttl_minutes')->default(10);
            $table->unsignedTinyInteger('max_attempts')->default(5);
            $table->string('sms_gateway')->nullable();
            $table->string('sms_masking')->nullable();
            $table->string('sms_api_url')->nullable();
            $table->string('sms_api_key')->nullable();
            $table->string('sms_username')->nullable();
            $table->string('sms_password')->nullable();
            $table->string('sms_sender')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_settings');
    }
};
