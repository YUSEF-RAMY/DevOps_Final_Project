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
            if (Schema::hasColumn('orders', 'billing_union')) {
                $table->dropColumn('billing_union');
            }
            if (Schema::hasColumn('orders', 'shipping_union')) {
                $table->dropColumn('shipping_union');
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
            if (!Schema::hasColumn('orders', 'billing_union')) {
                if (Schema::hasColumn('orders', 'billing_upazila')) {
                    $table->string('billing_union')->nullable()->after('billing_upazila');
                } else {
                    $table->string('billing_union')->nullable();
                }
            }
            if (!Schema::hasColumn('orders', 'shipping_union')) {
                if (Schema::hasColumn('orders', 'shipping_upazila')) {
                    $table->string('shipping_union')->nullable()->after('shipping_upazila');
                } else {
                    $table->string('shipping_union')->nullable();
                }
            }
        });
    }
};
