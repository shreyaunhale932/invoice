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
        Schema::table('products', function (Blueprint $table) {
            // Add item_product_data_id reference
            $table->unsignedBigInteger('item_product_data_id')->nullable()->after('id');
            $table->foreign('item_product_data_id')->references('id')->on('item_product_data')->onDelete('set null');

            // Remove old product_code column
            // Note: Unique constraint was already removed by migration 2025_12_17_045848
            $table->dropColumn('product_code');

            // Add pre_code and post_code for uniqueness
            $table->string('pre_code')->nullable()->after('item_product_data_id');
            $table->string('post_code')->nullable()->after('pre_code');
            
            // Add unique constraint on combination of pre_code and post_code
            $table->unique(['pre_code', 'post_code'], 'products_pre_post_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop foreign key and column
            $table->dropForeign(['item_product_data_id']);
            $table->dropColumn('item_product_data_id');

            // Drop unique constraint and columns
            $table->dropUnique('products_pre_post_code_unique');
            $table->dropColumn(['pre_code', 'post_code']);

            // Restore product_code
            $table->string('product_code')->unique()->after('id');
        });
    }
};

