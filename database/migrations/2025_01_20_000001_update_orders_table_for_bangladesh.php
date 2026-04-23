<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('orders')) {
            return;
        }

        Schema::table('orders', function (Blueprint $table) {
            // Add Bangladeshi address fields for billing
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
            if (!Schema::hasColumn('orders', 'billing_union')) {
                if (Schema::hasColumn('orders', 'billing_upazila')) {
                    $table->string('billing_union')->nullable()->after('billing_upazila');
                } else {
                    $table->string('billing_union')->nullable();
                }
            }
            
            // Add Bangladeshi address fields for shipping
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
            if (!Schema::hasColumn('orders', 'shipping_union')) {
                if (Schema::hasColumn('orders', 'shipping_upazila')) {
                    $table->string('shipping_union')->nullable()->after('shipping_upazila');
                } else {
                    $table->string('shipping_union')->nullable();
                }
            }
            
            // Add payment transaction details
            if (!Schema::hasColumn('orders', 'payment_transaction_id')) {
                if (Schema::hasColumn('orders', 'payment_method')) {
                    $table->string('payment_transaction_id')->nullable()->after('payment_method');
                } else {
                    $table->string('payment_transaction_id')->nullable();
                }
            }
            if (!Schema::hasColumn('orders', 'payment_transaction_details')) {
                if (Schema::hasColumn('orders', 'payment_transaction_id')) {
                    $table->text('payment_transaction_details')->nullable()->after('payment_transaction_id');
                } else {
                    $table->text('payment_transaction_details')->nullable();
                }
            }
            
            // Add shipping courier details
            if (!Schema::hasColumn('orders', 'shipping_courier')) {
                if (Schema::hasColumn('orders', 'shipping_method')) {
                    $table->string('shipping_courier')->nullable()->after('shipping_method');
                } else {
                    $table->string('shipping_courier')->nullable();
                }
            }
            if (!Schema::hasColumn('orders', 'shipping_tracking_number')) {
                if (Schema::hasColumn('orders', 'shipping_courier')) {
                    $table->string('shipping_tracking_number')->nullable()->after('shipping_courier');
                } else {
                    $table->string('shipping_tracking_number')->nullable();
                }
            }
            
            // Change default currency to BDT (if column exists)
            if (Schema::hasColumn('orders', 'currency')) {
                $table->string('currency', 3)->default('BDT')->change();
            }
        });
    }

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
            if (Schema::hasColumn('orders', 'billing_union')) $columnsToDrop[] = 'billing_union';
            if (Schema::hasColumn('orders', 'shipping_division')) $columnsToDrop[] = 'shipping_division';
            if (Schema::hasColumn('orders', 'shipping_district')) $columnsToDrop[] = 'shipping_district';
            if (Schema::hasColumn('orders', 'shipping_upazila')) $columnsToDrop[] = 'shipping_upazila';
            if (Schema::hasColumn('orders', 'shipping_union')) $columnsToDrop[] = 'shipping_union';
            if (Schema::hasColumn('orders', 'payment_transaction_id')) $columnsToDrop[] = 'payment_transaction_id';
            if (Schema::hasColumn('orders', 'payment_transaction_details')) $columnsToDrop[] = 'payment_transaction_details';
            if (Schema::hasColumn('orders', 'shipping_courier')) $columnsToDrop[] = 'shipping_courier';
            if (Schema::hasColumn('orders', 'shipping_tracking_number')) $columnsToDrop[] = 'shipping_tracking_number';
            
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
            
            if (Schema::hasColumn('orders', 'currency')) {
                $table->string('currency', 3)->default('USD')->change();
            }
        });
    }
};

