<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sell_invoice_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firm_id')->nullable();
            $table->unsignedBigInteger('sell_invoice_id');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->string('payment_method'); // cash, card, cheque, upi
            $table->decimal('amount', 15, 2)->default(0.00);
            $table->string('reference_no')->nullable(); // card no, cheque no, transaction id
            $table->text('payment_details')->nullable(); // cheque date, bank name, etc.
            $table->date('transaction_date')->nullable();
            $table->timestamps();

            $table->foreign('sell_invoice_id')
                ->references('id')
                ->on('sell_invoices')
                ->onDelete('cascade');

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sell_invoice_payments');
    }
};
