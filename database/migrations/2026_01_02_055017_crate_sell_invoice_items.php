<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sell_invoice_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sell_invoice_id');
            $table->unsignedBigInteger('product_id')->nullable();

            $table->string('item_name')->nullable();
            $table->string('purity')->nullable();

            // Weights
            $table->decimal('gross_weight')->default(0);
            $table->decimal('net_weight')->default(0);
            $table->decimal('fine_weight')->default(0);

            // Amounts
            $table->decimal('metal_rate')->default(0);
            $table->decimal('gold_amount')->default(0);
            $table->decimal('diamond_amount')->default(0);
            $table->decimal('stone_amount')->default(0);
            $table->decimal('making_charges')->default(0);
            $table->decimal('other_charges')->default(0);
            $table->decimal('total_amount')->default(0);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();

            $table->timestamps();

            $table->foreign('sell_invoice_id')
                  ->references('id')->on('sell_invoices')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sell_invoice_items');
    }
};
