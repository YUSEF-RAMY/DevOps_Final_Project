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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['percentage', 'fixed']); // percentage or fixed amount
            $table->decimal('value', 10, 2); // percentage (0-100) or fixed amount
            $table->decimal('minimum_amount', 10, 2)->nullable(); // minimum order amount
            $table->decimal('maximum_discount', 10, 2)->nullable(); // maximum discount for percentage coupons
            $table->integer('usage_limit')->nullable(); // total usage limit
            $table->integer('usage_limit_per_user')->nullable(); // usage limit per user
            $table->date('starts_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('applicable_categories')->nullable(); // specific categories
            $table->json('applicable_products')->nullable(); // specific products
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};