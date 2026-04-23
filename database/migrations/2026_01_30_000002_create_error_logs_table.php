<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('error_logs', function (Blueprint $table) {
            $table->id();
            $table->string('type', 100)->nullable();
            $table->string('message', 500);
            $table->string('file', 500)->nullable();
            $table->unsignedInteger('line')->nullable();
            $table->string('url', 1000)->nullable();
            $table->string('method', 20)->nullable();
            $table->text('trace')->nullable();
            $table->text('context')->nullable();
            $table->string('user_type', 50)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('error_logs');
    }
};
