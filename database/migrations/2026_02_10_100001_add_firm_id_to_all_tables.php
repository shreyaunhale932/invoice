<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * The tables that should be scoped by firm.
     */
    protected $tables = [
        'products',
        'categories',
        'subcategories',
        'item_product_data',
        'sell_invoices',
        'sell_invoice_items',
        'expenses',
        'accounts',
        'account_groups',
        'journal_entries',
        'journal_entry_lines',
        'customers',
        'clients',
        'inventory_transactions',
        'invoice_template_settings',
        'invoice_template_custom_blocks',
        'metal_rates',
        'purity',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add firm_id column to all tables
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    if (!Schema::hasColumn($tableName, 'firm_id')) {
                        $table->unsignedBigInteger('firm_id')->nullable();
                    }
                });
            }
        }

        // 2. Create a default firm if records exist in any table
        $hasData = false;
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName) && DB::table($tableName)->exists()) {
                $hasData = true;
                break;
            }
        }

        if ($hasData) {
            $firmId = DB::table('firms')->insertGetId([
                'name' => 'Default Firm',
                'is_default' => true,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. Assign existing records to the default firm
            foreach ($this->tables as $tableName) {
                if (Schema::hasTable($tableName)) {
                    DB::table($tableName)->update(['firm_id' => $firmId]);
                }
            }
        }

        // 4. Add foreign key constraints (optional, but good for integrity)
        // We'll skip foreign keys for now to avoid issues with existing data patterns, 
        // but we'll make the column non-nullable eventually if needed.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('firm_id');
                });
            }
        }
    }
};
