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
           $table->decimal('igst_percent', 5, 2)->default(0)->after('sgst_percent');
            $table->decimal('igst_amount', 15, 2)->default(0)->after('igst_percent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sell_invoices', function (Blueprint $table) {
            $table->dropColumn(['igst_percent', 'igst_amount']);
        });
    }
};
