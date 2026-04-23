<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'coins_balance')) {
                $table->unsignedBigInteger('coins_balance')->default(0)->after('password');
            }
        });

        Schema::create('user_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('type')->index(); // add_to_cart, order_place, admin_adjust, referral, etc.
            $table->bigInteger('amount'); // positive or negative
            $table->string('description')->nullable();
            $table->nullableMorphs('related'); // related model (order, cart_item, etc.)
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->index(['user_id','type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_points');
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'coins_balance')) {
                $table->dropColumn('coins_balance');
            }
        });
    }
};


