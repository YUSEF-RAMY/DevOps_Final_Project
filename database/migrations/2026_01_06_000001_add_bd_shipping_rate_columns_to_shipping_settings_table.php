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
            // flat_rate (used by admin + checkout fallback)
            if (!Schema::hasColumn('shipping_settings', 'flat_rate')) {
                if (Schema::hasColumn('shipping_settings', 'enabled')) {
                    $table->decimal('flat_rate', 10, 2)->default(0)->after('enabled');
                } else {
                    $table->decimal('flat_rate', 10, 2)->default(0);
                }
            }

            // division_rates (Bangladesh divisions)
            if (!Schema::hasColumn('shipping_settings', 'division_rates')) {
                if (Schema::hasColumn('shipping_settings', 'free_shipping_min_total')) {
                    $table->json('division_rates')->nullable()->after('free_shipping_min_total');
                } else {
                    $table->json('division_rates')->nullable();
                }
            }

            // district_rates (Bangladesh districts)
            if (!Schema::hasColumn('shipping_settings', 'district_rates')) {
                if (Schema::hasColumn('shipping_settings', 'division_rates')) {
                    $table->json('district_rates')->nullable()->after('division_rates');
                } else {
                    $table->json('district_rates')->nullable();
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
            $cols = [];
            if (Schema::hasColumn('shipping_settings', 'flat_rate')) $cols[] = 'flat_rate';
            if (Schema::hasColumn('shipping_settings', 'division_rates')) $cols[] = 'division_rates';
            if (Schema::hasColumn('shipping_settings', 'district_rates')) $cols[] = 'district_rates';
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};


