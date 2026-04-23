<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('enabled')->default(true);
            $table->boolean('free_shipping_enabled')->default(true);
            $table->decimal('free_shipping_min_total', 10, 2)->default(0);
            $table->json('country_rates')->nullable(); // {"United States": {"type":"flat","amount":5}, ...}
            $table->boolean('global_rate_enabled')->default(false);
            $table->string('global_rate_type', 20)->default('flat');
            $table->decimal('global_rate_amount', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_settings');
    }
};


