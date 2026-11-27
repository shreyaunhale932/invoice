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
    // This table belongs to the landlord database.
    // Skip creation if it already exists.
    if (Schema::connection('landlord')->hasTable('subscription_invoices')) {
        return;
    }

    Schema::connection('landlord')->create('subscription_invoices', function (Blueprint $table) {
        $table->id();

        $table->foreignId('admin_subscription_id')
            ->constrained('admin_subscriptions')
            ->restrictOnDelete();

        $table->foreignId('subscription_payment_id')
            ->unique()
            ->constrained('subscription_payments')
            ->restrictOnDelete();

        $table->string('invoice_number')->unique();
        $table->string('customer_name');
        $table->string('customer_email');
        $table->string('customer_gstin')->nullable();
        $table->text('billing_address')->nullable();
        $table->string('place_of_supply')->nullable();

        $table->decimal('taxable_amount', 10, 2);
        $table->decimal('cgst_amount', 10, 2)->default(0);
        $table->decimal('sgst_amount', 10, 2)->default(0);
        $table->decimal('igst_amount', 10, 2)->default(0);
        $table->decimal('gst_rate', 5, 2)->default(18);

        $table->decimal('total_amount', 10, 2);
        $table->string('currency', 3)->default('INR');
        $table->string('status')->default('generated');
        $table->string('pdf_path')->nullable();
        $table->timestamp('issued_at')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_invoices');
    }
};
