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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->boolean('schema_enabled')->default(true)->after('product_display_columns_desktop');
            $table->string('schema_organization_name')->nullable()->after('schema_enabled');
            $table->string('schema_organization_logo')->nullable()->after('schema_organization_name');
            $table->string('schema_organization_phone')->nullable()->after('schema_organization_logo');
            $table->string('schema_organization_email')->nullable()->after('schema_organization_phone');
            $table->text('schema_organization_address')->nullable()->after('schema_organization_email');
            $table->string('schema_organization_type')->default('Store')->after('schema_organization_address');
            $table->boolean('sitemap_enabled')->default(true)->after('schema_organization_type');
            $table->integer('sitemap_priority_home')->default(10)->after('sitemap_enabled');
            $table->integer('sitemap_priority_product')->default(8)->after('sitemap_priority_home');
            $table->integer('sitemap_priority_category')->default(7)->after('sitemap_priority_product');
            $table->integer('sitemap_priority_page')->default(6)->after('sitemap_priority_category');
            $table->string('sitemap_change_frequency')->default('weekly')->after('sitemap_priority_page');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'schema_enabled',
                'schema_organization_name',
                'schema_organization_logo',
                'schema_organization_phone',
                'schema_organization_email',
                'schema_organization_address',
                'schema_organization_type',
                'sitemap_enabled',
                'sitemap_priority_home',
                'sitemap_priority_product',
                'sitemap_priority_category',
                'sitemap_priority_page',
                'sitemap_change_frequency',
            ]);
        });
    }
};
