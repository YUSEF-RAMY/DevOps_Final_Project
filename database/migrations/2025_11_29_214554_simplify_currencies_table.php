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
        Schema::table('currencies', function (Blueprint $table) {
            // Remove complex formatting fields - we'll use defaults for BDT
            if (Schema::hasColumn('currencies', 'precision')) {
                $table->dropColumn('precision');
            }
            if (Schema::hasColumn('currencies', 'thousand_separator')) {
                $table->dropColumn('thousand_separator');
            }
            if (Schema::hasColumn('currencies', 'decimal_separator')) {
                $table->dropColumn('decimal_separator');
            }
            if (Schema::hasColumn('currencies', 'symbol_first')) {
                $table->dropColumn('symbol_first');
            }
            if (Schema::hasColumn('currencies', 'rate')) {
                $table->dropColumn('rate');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->unsignedTinyInteger('precision')->default(2)->after('symbol');
            $table->string('thousand_separator')->default(',')->after('precision');
            $table->string('decimal_separator')->default('.')->after('thousand_separator');
            $table->boolean('symbol_first')->default(true)->after('decimal_separator');
            $table->decimal('rate', 15, 8)->default(1)->after('symbol_first');
        });
    }
};
