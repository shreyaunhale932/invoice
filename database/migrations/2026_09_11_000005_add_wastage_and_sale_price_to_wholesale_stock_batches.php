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
        if (Schema::hasTable('wholesale_stock_batches')) {
            Schema::table('wholesale_stock_batches', function (Blueprint $table) {
                if (!Schema::hasColumn('wholesale_stock_batches', 'wastage_percent')) {
                    $table->decimal('wastage_percent', 10, 2)->default(0)->after('making_type');
                }
                if (!Schema::hasColumn('wholesale_stock_batches', 'sale_price')) {
                    $table->decimal('sale_price', 15, 2)->default(0)->after('wastage_percent');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('wholesale_stock_batches')) {
            Schema::table('wholesale_stock_batches', function (Blueprint $table) {
                if (Schema::hasColumn('wholesale_stock_batches', 'wastage_percent')) {
                    $table->dropColumn('wastage_percent');
                }
                if (Schema::hasColumn('wholesale_stock_batches', 'sale_price')) {
                    $table->dropColumn('sale_price');
                }
            });
        }
    }
};
