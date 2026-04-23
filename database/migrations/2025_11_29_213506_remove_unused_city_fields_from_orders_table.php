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
            // Remove unused city fields (we use upazila now)
            if (Schema::hasColumn('orders', 'billing_city')) {
                $table->dropColumn('billing_city');
            }
            if (Schema::hasColumn('orders', 'shipping_city')) {
                $table->dropColumn('shipping_city');
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
            if (!Schema::hasColumn('orders', 'billing_city')) {
                if (Schema::hasColumn('orders', 'billing_address')) {
                    $table->string('billing_city')->nullable()->after('billing_address');
                } else {
                    $table->string('billing_city')->nullable();
                }
            }
            if (!Schema::hasColumn('orders', 'shipping_city')) {
                if (Schema::hasColumn('orders', 'shipping_address')) {
                    $table->string('shipping_city')->nullable()->after('shipping_address');
                } else {
                    $table->string('shipping_city')->nullable();
                }
            }
        });
    }
};
