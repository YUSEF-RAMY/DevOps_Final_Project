<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->text('value');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default email settings
        DB::table('email_settings')->insert([
            [
                'key' => 'from_name',
                'name' => 'From Name',
                'value' => 'eCommerce Store',
                'description' => 'The name that appears in the "From" field of emails',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'from_email',
                'name' => 'From Email',
                'value' => 'noreply@ecommercestore.com',
                'description' => 'The email address that appears in the "From" field of emails',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'order_confirmation_enabled',
                'name' => 'Order Confirmation Emails',
                'value' => '1',
                'description' => 'Send confirmation emails when orders are placed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'order_status_update_enabled',
                'name' => 'Order Status Update Emails',
                'value' => '1',
                'description' => 'Send emails when order status is updated',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_settings');
    }
};