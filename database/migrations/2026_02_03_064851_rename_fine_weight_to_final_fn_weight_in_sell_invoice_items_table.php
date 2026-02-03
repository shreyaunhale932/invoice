<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            // rename column
            $table->renameColumn('fine_weight', 'final_fn_weight');
        });

        // change datatype to decimal(10,3)
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            $table->decimal('final_fn_weight', 10, 3)->change();
        });
    }

    public function down(): void
    {
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            // revert datatype if needed
            $table->decimal('fine_weight', 10, 3)->change();
        });

        Schema::table('sell_invoice_items', function (Blueprint $table) {
            // rename back
            $table->renameColumn('final_fn_weight', 'fine_weight');
        });
    }
};
