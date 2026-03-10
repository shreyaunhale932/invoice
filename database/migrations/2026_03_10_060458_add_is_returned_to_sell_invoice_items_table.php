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
            $table->boolean('is_returned')->default(false)->after('final_price');
            $table->date('return_date')->nullable()->after('is_returned');
            $table->decimal('return_amount', 15, 2)->default(0)->after('return_date');
            $table->text('return_reason')->nullable()->after('return_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            $table->dropColumn(['is_returned', 'return_date', 'return_amount', 'return_reason']);
        });
    }
};
