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
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            $table->decimal('wastage_percent')
                  ->nullable()
                  ->after('net_weight'); // change column name if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            $table->dropColumn('wastage_percent');
        });
    }
};
