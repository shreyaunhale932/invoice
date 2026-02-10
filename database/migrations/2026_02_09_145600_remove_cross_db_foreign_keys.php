<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = [
            'customers' => 'customers_admin_id_foreign',
            'clients' => 'clients_admin_id_foreign',
            'custom_field_definitions' => 'custom_field_definitions_admin_id_foreign',
            'metal_rates' => 'metal_rates_admin_id_foreign',
            'categories' => 'categories_admin_id_foreign',
            'subcategories' => 'subcategories_admin_id_foreign',
            'products' => 'products_admin_id_foreign',
            'product_stones' => 'product_stones_admin_id_foreign',
            'diamond_details' => 'diamond_details_admin_id_foreign',
            'invoice_notes_terms' => 'invoice_notes_terms_admin_id_foreign',
        ];

        foreach ($tables as $table => $constraint) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) use ($constraint) {
                    // We use a raw check to see if the constraint exists to avoid migration failures
                    $exists = DB::select("
                        SELECT CONSTRAINT_NAME 
                        FROM information_schema.KEY_COLUMN_USAGE 
                        WHERE TABLE_SCHEMA = DATABASE() 
                        AND TABLE_NAME = ? 
                        AND CONSTRAINT_NAME = ?
                    ", [$table->getTable(), $constraint]);

                    if (!empty($exists)) {
                        $table->dropForeign($constraint);
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Adding them back would still be invalid since the referenced 'users' table 
        // is in a different database, but for standard migration structure:
        // (Skipping for now as they are fundamentally incorrect in this architecture)
    }
};
