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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique(); // e.g., USD, EUR
            $table->string('name'); // US Dollar
            $table->string('symbol'); // $
            $table->unsignedTinyInteger('precision')->default(2); // decimal places
            $table->string('thousand_separator')->default(',');
            $table->string('decimal_separator')->default('.');
            $table->boolean('symbol_first')->default(true);
            $table->decimal('rate', 15, 8)->default(1); // relative to base
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
