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
            $table->decimal('packet_amount', 15, 2)->default(0)->after('stone_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            $table->dropColumn('packet_amount');
        });
    }
};
