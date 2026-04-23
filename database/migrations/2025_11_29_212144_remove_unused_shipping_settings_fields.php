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
        if (!Schema::hasTable('shipping_settings')) {
            return;
        }

        Schema::table('shipping_settings', function (Blueprint $table) {
            // Remove weight-based shipping fields (not on admin page)
            if (Schema::hasColumn('shipping_settings', 'weight_based_enabled')) {
                $table->dropColumn('weight_based_enabled');
            }
            if (Schema::hasColumn('shipping_settings', 'weight_base_rate')) {
                $table->dropColumn('weight_base_rate');
            }
            if (Schema::hasColumn('shipping_settings', 'weight_per_kg_rate')) {
                $table->dropColumn('weight_per_kg_rate');
            }
            
            // Remove global rate fields (not on admin page)
            if (Schema::hasColumn('shipping_settings', 'global_rate_enabled')) {
                $table->dropColumn('global_rate_enabled');
            }
            if (Schema::hasColumn('shipping_settings', 'global_rate_type')) {
                $table->dropColumn('global_rate_type');
            }
            if (Schema::hasColumn('shipping_settings', 'global_rate_amount')) {
                $table->dropColumn('global_rate_amount');
            }
            
            // Remove country_rates if it exists (not on admin page)
            if (Schema::hasColumn('shipping_settings', 'country_rates')) {
                $table->dropColumn('country_rates');
            }
            
            // Remove courier_services if it exists (not on admin page)
            if (Schema::hasColumn('shipping_settings', 'courier_services')) {
                $table->dropColumn('courier_services');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('shipping_settings')) {
            return;
        }

        Schema::table('shipping_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('shipping_settings', 'weight_based_enabled')) {
                $table->boolean('weight_based_enabled')->default(false);
            }
            if (!Schema::hasColumn('shipping_settings', 'weight_base_rate')) {
                $table->decimal('weight_base_rate', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('shipping_settings', 'weight_per_kg_rate')) {
                $table->decimal('weight_per_kg_rate', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('shipping_settings', 'global_rate_enabled')) {
                $table->boolean('global_rate_enabled')->default(false);
            }
            if (!Schema::hasColumn('shipping_settings', 'global_rate_type')) {
                $table->string('global_rate_type', 20)->default('flat');
            }
            if (!Schema::hasColumn('shipping_settings', 'global_rate_amount')) {
                $table->decimal('global_rate_amount', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('shipping_settings', 'country_rates')) {
                $table->json('country_rates')->nullable();
            }
            if (!Schema::hasColumn('shipping_settings', 'courier_services')) {
                $table->json('courier_services')->nullable();
            }
        });
    }
};
