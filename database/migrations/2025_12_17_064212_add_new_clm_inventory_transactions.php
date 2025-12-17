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
        Schema::table('inventory_transactions', function (Blueprint $table) {
            $table->decimal('net_weight')->nullable()->after('gross_weight');
            $table->decimal('final_fn_weight')->nullable()->after('net_weight');
            $table->integer('quantity')->default(1)->after('final_fn_weight');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_transactions', function (Blueprint $table) {
            $table->dropColumn(['net_weight', 'final_fn_weight', 'quantity']);
        });
    }
};
