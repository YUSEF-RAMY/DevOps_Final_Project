<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shipping_settings', function (Blueprint $table) {
            $table->boolean('tax_enabled')->default(false)->after('global_rate_amount');
            $table->string('tax_type', 20)->default('percent')->after('tax_enabled');
            $table->decimal('tax_rate', 10, 2)->default(0)->after('tax_type');
        });
    }

    public function down(): void
    {
        Schema::table('shipping_settings', function (Blueprint $table) {
            $table->dropColumn(['tax_enabled', 'tax_type', 'tax_rate']);
        });
    }
};
