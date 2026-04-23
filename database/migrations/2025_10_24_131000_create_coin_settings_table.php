<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coin_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('coins_enabled')->default(true);
            $table->boolean('add_to_cart_enabled')->default(true);
            $table->boolean('order_award_enabled')->default(true);
            $table->boolean('cod_bonus_enabled')->default(true);
            $table->boolean('referral_enabled')->default(true);
            $table->unsignedInteger('add_to_cart_award')->default(1);
            $table->unsignedInteger('add_to_cart_daily_cap')->default(10);
            $table->unsignedInteger('order_rate_per')->default(100); // currency units per step
            $table->unsignedInteger('order_rate_coins')->default(1); // coins per step
            $table->unsignedInteger('order_min_award')->default(1);
            $table->unsignedInteger('cod_bonus')->default(1);
            $table->unsignedInteger('referral_signup_bonus')->default(10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coin_settings');
    }
};


