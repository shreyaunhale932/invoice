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
            if (!Schema::hasColumn('sell_invoices', 'total_exchange_amount')) {
                $table->decimal('total_exchange_amount', 15, 2)->default(0)->after('taxable_amount');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sell_invoices', function (Blueprint $table) {
            $table->dropColumn('total_exchange_amount');
        });
    }
};
