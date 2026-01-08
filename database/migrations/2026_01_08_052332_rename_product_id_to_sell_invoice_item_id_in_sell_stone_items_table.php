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
        Schema::table('sell_stone_items', function (Blueprint $table) {
            $table->renameColumn('product_id', 'sell_invoice_item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sell_stone_items', function (Blueprint $table) {
            $table->renameColumn('sell_invoice_item_id', 'product_id');
        });
    }
};
