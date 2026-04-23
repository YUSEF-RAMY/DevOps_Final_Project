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
        if (!Schema::hasTable('orders')) {
            return;
        }

        Schema::table('orders', function (Blueprint $table) {
            // Add Bangladeshi address fields for billing if they don't exist
            if (!Schema::hasColumn('orders', 'billing_division')) {
                if (Schema::hasColumn('orders', 'billing_country')) {
                    $table->string('billing_division')->nullable()->after('billing_country');
                } else {
                    $table->string('billing_division')->nullable();
                }
            }
            if (!Schema::hasColumn('orders', 'billing_district')) {
                if (Schema::hasColumn('orders', 'billing_division')) {
                    $table->string('billing_district')->nullable()->after('billing_division');
                } else {
                    $table->string('billing_district')->nullable();
                }
            }
            if (!Schema::hasColumn('orders', 'billing_upazila')) {
                if (Schema::hasColumn('orders', 'billing_district')) {
                    $table->string('billing_upazila')->nullable()->after('billing_district');
                } else {
                    $table->string('billing_upazila')->nullable();
                }
            }
            
            // Add Bangladeshi address fields for shipping if they don't exist
            if (!Schema::hasColumn('orders', 'shipping_division')) {
                if (Schema::hasColumn('orders', 'shipping_country')) {
                    $table->string('shipping_division')->nullable()->after('shipping_country');
                } else {
                    $table->string('shipping_division')->nullable();
                }
            }
            if (!Schema::hasColumn('orders', 'shipping_district')) {
                if (Schema::hasColumn('orders', 'shipping_division')) {
                    $table->string('shipping_district')->nullable()->after('shipping_division');
                } else {
                    $table->string('shipping_district')->nullable();
                }
            }
            if (!Schema::hasColumn('orders', 'shipping_upazila')) {
                if (Schema::hasColumn('orders', 'shipping_district')) {
                    $table->string('shipping_upazila')->nullable()->after('shipping_district');
                } else {
                    $table->string('shipping_upazila')->nullable();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('orders')) {
            return;
        }

        Schema::table('orders', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('orders', 'billing_division')) $columnsToDrop[] = 'billing_division';
            if (Schema::hasColumn('orders', 'billing_district')) $columnsToDrop[] = 'billing_district';
            if (Schema::hasColumn('orders', 'billing_upazila')) $columnsToDrop[] = 'billing_upazila';
            if (Schema::hasColumn('orders', 'shipping_division')) $columnsToDrop[] = 'shipping_division';
            if (Schema::hasColumn('orders', 'shipping_district')) $columnsToDrop[] = 'shipping_district';
            if (Schema::hasColumn('orders', 'shipping_upazila')) $columnsToDrop[] = 'shipping_upazila';
            
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
