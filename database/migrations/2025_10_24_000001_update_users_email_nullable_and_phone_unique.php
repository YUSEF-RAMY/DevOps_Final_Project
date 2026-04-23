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
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE `users` MODIFY `email` VARCHAR(255) NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE users ALTER COLUMN email DROP NOT NULL');
        } elseif ($driver === 'sqlsrv') {
            DB::statement('ALTER TABLE [users] ALTER COLUMN [email] NVARCHAR(255) NULL');
        } else {
            // For sqlite or unknown drivers, attempt a best-effort change; if unsupported, developer may need to adjust manually
            try {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('email')->nullable()->change();
                });
            } catch (\Throwable $e) {
                // noop
            }
        }

        if (Schema::hasColumn('users', 'phone')) {
            // Create a stable index name so down() can reliably drop it later
            try {
                Schema::table('users', function (Blueprint $table) {
                    $table->unique('phone', 'users_phone_unique');
                });
            } catch (\Throwable $e) {
                // Index may already exist; ignore
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if (Schema::hasColumn('users', 'phone')) {
            try {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropUnique('users_phone_unique');
                });
            } catch (\Throwable $e) {
                // Index might not exist; ignore
            }
        }

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE `users` MODIFY `email` VARCHAR(255) NOT NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE users ALTER COLUMN email SET NOT NULL');
        } elseif ($driver === 'sqlsrv') {
            DB::statement('ALTER TABLE [users] ALTER COLUMN [email] NVARCHAR(255) NOT NULL');
        } else {
            try {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('email')->nullable(false)->change();
                });
            } catch (\Throwable $e) {
                // noop
            }
        }
    }

    // no-op helper removed to avoid doctrine/dbal dependency
};


