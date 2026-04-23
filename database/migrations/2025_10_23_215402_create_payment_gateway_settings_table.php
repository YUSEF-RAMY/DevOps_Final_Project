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
        Schema::create('payment_gateway_settings', function (Blueprint $table) {
            $table->id();
            $table->string('gateway')->index(); // stripe, paypal, etc.
            $table->string('key'); // setting key like 'api_key', 'enabled', etc.
            $table->text('value')->nullable(); // setting value
            $table->text('description')->nullable(); // description of the setting
            $table->boolean('is_encrypted')->default(false); // whether value should be encrypted
            $table->timestamps();
            
            $table->unique(['gateway', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_gateway_settings');
    }
};
