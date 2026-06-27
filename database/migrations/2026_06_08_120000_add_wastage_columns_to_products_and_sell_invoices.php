<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'wastage_amount')) {
                $table->decimal('wastage_amount', 10, 2)->nullable()->after('wastage_percent');
            }
        });

        Schema::table('item_product_data', function (Blueprint $table) {
            if (!Schema::hasColumn('item_product_data', 'wastage_amount')) {
                $table->decimal('wastage_amount', 10, 2)->nullable()->after('wastage_percent');
            }
        });

        Schema::table('sell_invoice_items', function (Blueprint $table) {
            if (!Schema::hasColumn('sell_invoice_items', 'wastage_amount')) {
                $table->decimal('wastage_amount', 10, 2)->nullable()->after('wastage_percent');
            }
        });

        Schema::table('sell_invoices', function (Blueprint $table) {
            if (!Schema::hasColumn('sell_invoices', 'total_wastage_charge')) {
                $table->decimal('total_wastage_charge', 15, 2)->default(0.00)->after('total_making_charge');
            }
            if (!Schema::hasColumn('sell_invoices', 'wastage_discount_percent')) {
                $table->decimal('wastage_discount_percent', 5, 2)->default(0.00)->after('total_wastage_charge');
            }
            if (!Schema::hasColumn('sell_invoices', 'wastage_discount_amount')) {
                $table->decimal('wastage_discount_amount', 15, 2)->default(0.00)->after('wastage_discount_percent');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'wastage_amount')) {
                $table->dropColumn('wastage_amount');
            }
        });

        Schema::table('item_product_data', function (Blueprint $table) {
            if (Schema::hasColumn('item_product_data', 'wastage_amount')) {
                $table->dropColumn('wastage_amount');
            }
        });

        Schema::table('sell_invoice_items', function (Blueprint $table) {
            if (Schema::hasColumn('sell_invoice_items', 'wastage_amount')) {
                $table->dropColumn('wastage_amount');
            }
        });

        Schema::table('sell_invoices', function (Blueprint $table) {
            $cols = ['total_wastage_charge', 'wastage_discount_percent', 'wastage_discount_amount'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('sell_invoices', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
