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
            $table->string('making_type')->nullable()->after('making_price');
            $table->decimal('making_final_amount', 12, 2)->nullable()->after('making_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            $table->dropColumn(['making_type', 'making_final_amount']);
        });
    }
};
