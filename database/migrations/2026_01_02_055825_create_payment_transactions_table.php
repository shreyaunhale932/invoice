<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('firm_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            
            $table->decimal('amount', 15, 2);
            $table->enum('transaction_type', ['advance', 'udhaar_payment', 'refund', 'sale_payment']);
            $table->enum('payment_method', ['cash', 'bank', 'online']);
            
            $table->date('transaction_date')->nullable();
            $table->string('reference_no')->nullable();
            $table->text('narration')->nullable();
            $table->string('status')->default('completed');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();

            $table->timestamps();

            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
