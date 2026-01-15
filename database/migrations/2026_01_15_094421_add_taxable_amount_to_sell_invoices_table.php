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
        Schema::table('sell_invoices', function (Blueprint $table) {
            $table->decimal('taxable_amount', 15, 2)
                  ->default(0)
                  ->after('total_received'); // change column if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sell_invoices', function (Blueprint $table) {
            $table->dropColumn('taxable_amount');
        });
    }
};
