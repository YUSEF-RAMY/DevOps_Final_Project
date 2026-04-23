<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('shipping_settings')) {
            return;
        }

        Schema::table('shipping_settings', function (Blueprint $table) {
            // Add flat_rate if not exists (from previous migration)
            if (!Schema::hasColumn('shipping_settings', 'flat_rate')) {
                if (Schema::hasColumn('shipping_settings', 'enabled')) {
                    $table->decimal('flat_rate', 10, 2)->default(0)->after('enabled');
                } else {
                    $table->decimal('flat_rate', 10, 2)->default(0);
                }
            }
            
            // Add Bangladeshi-specific shipping fields
            if (!Schema::hasColumn('shipping_settings', 'division_rates')) {
                if (Schema::hasColumn('shipping_settings', 'country_rates')) {
                    $table->json('division_rates')->nullable()->after('country_rates'); // Division-based rates
                } else {
                    $table->json('division_rates')->nullable();
                }
            }
            if (!Schema::hasColumn('shipping_settings', 'district_rates')) {
                if (Schema::hasColumn('shipping_settings', 'division_rates')) {
                    $table->json('district_rates')->nullable()->after('division_rates'); // District-based rates
                } else {
                    $table->json('district_rates')->nullable();
                }
            }
            if (!Schema::hasColumn('shipping_settings', 'courier_services')) {
                if (Schema::hasColumn('shipping_settings', 'district_rates')) {
                    $table->json('courier_services')->nullable()->after('district_rates'); // Available courier services
                } else {
                    $table->json('courier_services')->nullable();
                }
            }
            if (!Schema::hasColumn('shipping_settings', 'weight_based_enabled')) {
                if (Schema::hasColumn('shipping_settings', 'courier_services')) {
                    $table->boolean('weight_based_enabled')->default(false)->after('courier_services');
                } else {
                    $table->boolean('weight_based_enabled')->default(false);
                }
            }
            if (!Schema::hasColumn('shipping_settings', 'weight_base_rate')) {
                if (Schema::hasColumn('shipping_settings', 'weight_based_enabled')) {
                    $table->decimal('weight_base_rate', 10, 2)->default(0)->after('weight_based_enabled');
                } else {
                    $table->decimal('weight_base_rate', 10, 2)->default(0);
                }
            }
            if (!Schema::hasColumn('shipping_settings', 'weight_per_kg_rate')) {
                if (Schema::hasColumn('shipping_settings', 'weight_base_rate')) {
                    $table->decimal('weight_per_kg_rate', 10, 2)->default(0)->after('weight_base_rate');
                } else {
                    $table->decimal('weight_per_kg_rate', 10, 2)->default(0);
                }
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('shipping_settings')) {
            return;
        }

        Schema::table('shipping_settings', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('shipping_settings', 'division_rates')) $columnsToDrop[] = 'division_rates';
            if (Schema::hasColumn('shipping_settings', 'district_rates')) $columnsToDrop[] = 'district_rates';
            if (Schema::hasColumn('shipping_settings', 'courier_services')) $columnsToDrop[] = 'courier_services';
            if (Schema::hasColumn('shipping_settings', 'weight_based_enabled')) $columnsToDrop[] = 'weight_based_enabled';
            if (Schema::hasColumn('shipping_settings', 'weight_base_rate')) $columnsToDrop[] = 'weight_base_rate';
            if (Schema::hasColumn('shipping_settings', 'weight_per_kg_rate')) $columnsToDrop[] = 'weight_per_kg_rate';
            
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};

