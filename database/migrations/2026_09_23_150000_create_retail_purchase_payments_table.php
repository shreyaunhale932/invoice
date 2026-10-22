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
        Schema::create('retail_purchase_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firm_id')->nullable();
            $table->unsignedBigInteger('retail_purchase_id');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->string('payment_method'); // cash, card, cheque, upi
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('reference_no')->nullable();
            $table->string('payment_details')->nullable();
            $table->date('transaction_date')->nullable();
            $table->timestamps();

            $table->foreign('retail_purchase_id')->references('id')->on('retail_purchases')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_purchase_payments');
    }
};
