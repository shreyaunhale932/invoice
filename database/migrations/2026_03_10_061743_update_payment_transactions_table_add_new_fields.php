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
        Schema::table('payment_transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('payment_transactions', 'firm_id')) {
                $table->unsignedBigInteger('firm_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('payment_transactions', 'customer_id')) {
                $table->unsignedBigInteger('customer_id')->nullable()->after('firm_id');
            }
            if (!Schema::hasColumn('payment_transactions', 'transaction_type')) {
                $table->string('transaction_type')->nullable()->after('customer_id'); // e.g., advance, udhaar_payment, refund, sale_payment
            }
            if (!Schema::hasColumn('payment_transactions', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('transaction_type'); // cash, bank, online
            }
            if (!Schema::hasColumn('payment_transactions', 'transaction_date')) {
                $table->date('transaction_date')->nullable()->after('payment_method');
            }
            if (!Schema::hasColumn('payment_transactions', 'reference_no')) {
                $table->string('reference_no')->nullable()->after('transaction_date');
            }
            if (!Schema::hasColumn('payment_transactions', 'narration')) {
                $table->text('narration')->nullable()->after('reference_no');
            }
            if (!Schema::hasColumn('payment_transactions', 'status')) {
                $table->string('status')->default('completed')->after('narration');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->dropColumn([
                'firm_id', 'customer_id', 'transaction_type', 'payment_method', 
                'transaction_date', 'reference_no', 'narration', 'status'
            ]);
        });
    }
};
