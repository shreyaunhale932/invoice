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
        Schema::create('sell_stone_items', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->unsignedBigInteger('sell_invoice_id');
            $table->unsignedBigInteger('product_id')->nullable();

            // Stone details
            $table->string('stone_name')->nullable();
            $table->decimal('stone_weight')->default(0);
            $table->decimal('stone_price')->default(0);
            $table->decimal('stone_final_price')->default(0);

            // Optional helpers
            $table->integer('pieces')->nullable();
            $table->text('remark')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('sell_invoice_id')
                  ->references('id')
                  ->on('sell_invoices')
                  ->onDelete('cascade');

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_stone_items');
    }
};
