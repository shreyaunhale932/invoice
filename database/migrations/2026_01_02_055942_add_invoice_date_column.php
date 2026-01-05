<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sell_invoices', function (Blueprint $table) {
            $table->date('invoice_date')->nullable()->after('invoice_no');
            $table->date('invoice_due_date')->nullable()->after('invoice_date');
        });
    }

    public function down(): void
    {
        Schema::table('sell_invoices', function (Blueprint $table) {
            $table->dropColumn(['invoice_date', 'invoice_due_date']);
        });
    }
};
