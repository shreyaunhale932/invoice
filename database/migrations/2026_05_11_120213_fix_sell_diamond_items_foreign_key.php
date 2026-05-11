<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run migrations
     */
    public function up(): void
    {
        // Get foreign keys dynamically
        $foreignKeys = DB::select("
            SELECT CONSTRAINT_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
            AND TABLE_NAME = 'sell_diamond_items'
            AND COLUMN_NAME = 'sell_invoice_item_id'
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ");

        // Drop all existing foreign keys
        foreach ($foreignKeys as $fk) {
            DB::statement("
                ALTER TABLE sell_diamond_items
                DROP FOREIGN KEY {$fk->CONSTRAINT_NAME}
            ");
        }

        // Add correct foreign key
        Schema::table('sell_diamond_items', function (Blueprint $table) {

            $table->foreign('sell_invoice_item_id')
                ->references('id')
                ->on('sell_invoice_items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse migrations
     */
    public function down(): void
    {
        Schema::table('sell_diamond_items', function (Blueprint $table) {

            $table->dropForeign(['sell_invoice_item_id']);

            $table->foreign('sell_invoice_item_id')
                ->references('id')
                ->on('products')
                ->onDelete('set null');
        });
    }
};
