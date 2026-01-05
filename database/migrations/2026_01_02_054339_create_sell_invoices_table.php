<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sell_invoices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();

            // GST
            $table->decimal('cgst_percent')->default(0);
            $table->decimal('cgst_amount')->default(0);
            $table->decimal('sgst_percent')->default(0);
            $table->decimal('sgst_amount')->default(0);

            // Metal totals
            $table->decimal('gold_total_amount')->default(0);
            $table->decimal('silver_total_amount')->default(0);
            $table->decimal('stone_total_amount')->default(0);

            // Charges
            $table->decimal('making_charge')->default(0);
            $table->decimal('other_charge')->default(0);
            $table->decimal('other_tax_amount')->default(0);

            // Totals
            $table->decimal('total_amount_non_tax')->default(0);
            $table->decimal('final_amount')->default(0);

            // Discount
            $table->decimal('discount_percent')->default(0);
            $table->decimal('discount_amount')->default(0);

            // Payments received
            $table->decimal('cash_received')->default(0);
            $table->decimal('online_received')->default(0);
            $table->decimal('bank_received')->default(0);
            $table->decimal('total_received')->default(0);
            $table->decimal('amount_left')->default(0);

            // Invoice numbers
            $table->string('invoice_no')->nullable();
            $table->string('per_invoice_no')->nullable();
            $table->string('post_invoice_no')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sell_invoices');
    }
};
