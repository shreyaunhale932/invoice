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
        Schema::table('inventory_transactions', function (Blueprint $table) {
            // Drop existing foreign key constraint first
            $table->dropForeign(['product_id']);

            // Make product_id nullable since we'll have item references
            $table->unsignedBigInteger('product_id')->nullable()->change();

            // Re-add foreign key constraint (nullable)
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Add item_product_data reference
            $table->unsignedBigInteger('item_product_data_id')->nullable()->after('product_id');
            $table->foreign('item_product_data_id')->references('id')->on('item_product_data')->onDelete('cascade');

            // Add item_diamond_details reference
            $table->unsignedBigInteger('item_diamond_id')->nullable()->after('item_product_data_id');
            $table->foreign('item_diamond_id')->references('diamond_id')->on('item_diamond_details')->onDelete('cascade');

            // Add item_product_stones reference
            $table->unsignedBigInteger('item_stone_id')->nullable()->after('item_diamond_id');
            $table->foreign('item_stone_id')->references('stone_id')->on('item_product_stones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_transactions', function (Blueprint $table) {
            // Drop foreign keys
            $table->dropForeign(['item_product_data_id']);
            $table->dropForeign(['item_diamond_id']);
            $table->dropForeign(['item_stone_id']);
            $table->dropForeign(['product_id']);

            // Drop columns
            $table->dropColumn(['item_product_data_id', 'item_diamond_id', 'item_stone_id']);

            // Restore product_id to not nullable
            $table->unsignedBigInteger('product_id')->nullable(false)->change();

            // Re-add foreign key constraint (not nullable)
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
};

