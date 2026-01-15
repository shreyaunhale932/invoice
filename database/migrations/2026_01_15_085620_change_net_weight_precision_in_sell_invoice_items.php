<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            $table->decimal('net_weight', 10, 3)->change();
        });
    }

    public function down(): void
    {
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            // rollback to old precision (adjust if yours was different)
            $table->decimal('net_weight', 10, 2)->change();
        });
    }
};
