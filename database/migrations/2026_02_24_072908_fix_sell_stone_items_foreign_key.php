<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Drop WRONG foreign key
        DB::statement("
            ALTER TABLE sell_stone_items
            DROP FOREIGN KEY sell_stone_items_product_id_foreign
        ");

        // Add CORRECT foreign key
        DB::statement("
            ALTER TABLE sell_stone_items
            ADD CONSTRAINT sell_stone_items_sell_invoice_item_id_foreign
            FOREIGN KEY (sell_invoice_item_id)
            REFERENCES sell_invoice_items(id)
            ON DELETE SET NULL
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE sell_stone_items
            DROP FOREIGN KEY sell_stone_items_sell_invoice_item_id_foreign
        ");

        DB::statement("
            ALTER TABLE sell_stone_items
            ADD CONSTRAINT sell_stone_items_product_id_foreign
            FOREIGN KEY (sell_invoice_item_id)
            REFERENCES products(id)
            ON DELETE SET NULL
        ");
    }
};
