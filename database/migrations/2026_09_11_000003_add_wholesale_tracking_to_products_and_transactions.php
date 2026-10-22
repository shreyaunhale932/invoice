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
            if (!Schema::hasColumn('products', 'wholesale_stock_id')) {
                $table->unsignedBigInteger('wholesale_stock_id')->nullable()->index()->after('item_product_data_id');
            }
            if (!Schema::hasColumn('products', 'wholesale_stock_batch_id')) {
                $table->unsignedBigInteger('wholesale_stock_batch_id')->nullable()->index()->after('wholesale_stock_id');
            }
            if (!Schema::hasColumn('products', 'retail_purchase_id')) {
                $table->unsignedBigInteger('retail_purchase_id')->nullable()->index()->after('wholesale_stock_batch_id');
            }
            if (!Schema::hasColumn('products', 'retail_purchase_item_id')) {
                $table->unsignedBigInteger('retail_purchase_item_id')->nullable()->index()->after('retail_purchase_id');
            }
            if (!Schema::hasColumn('products', 'supplier_id')) {
                $table->unsignedBigInteger('supplier_id')->nullable()->index()->after('retail_purchase_item_id');
            }
            if (!Schema::hasColumn('products', 'tagged_at')) {
                $table->timestamp('tagged_at')->nullable()->after('availability');
            }
            if (!Schema::hasColumn('products', 'tagged_by')) {
                $table->unsignedBigInteger('tagged_by')->nullable()->after('tagged_at');
            }
        });

        Schema::table('inventory_transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('inventory_transactions', 'wholesale_stock_id')) {
                $table->unsignedBigInteger('wholesale_stock_id')->nullable()->index()->after('item_product_data_id');
            }
            if (!Schema::hasColumn('inventory_transactions', 'wholesale_stock_batch_id')) {
                $table->unsignedBigInteger('wholesale_stock_batch_id')->nullable()->index()->after('wholesale_stock_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'wholesale_stock_id',
                'wholesale_stock_batch_id',
                'retail_purchase_id',
                'retail_purchase_item_id',
                'supplier_id',
                'tagged_at',
                'tagged_by'
            ]);
        });

        Schema::table('inventory_transactions', function (Blueprint $table) {
            $table->dropColumn(['wholesale_stock_id', 'wholesale_stock_batch_id']);
        });
    }
};
