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
        Schema::create('sell_diamond_items', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->unsignedBigInteger('sell_invoice_id');
            $table->unsignedBigInteger('product_id')->nullable();

            // Diamond details
            $table->string('clarity')->nullable();
            $table->string('cut')->nullable();
            $table->string('color')->nullable();
            $table->integer('pieces')->nullable();

            $table->decimal('diamond_weight')->default(0);
            $table->decimal('price_per_carat')->default(0);
            $table->decimal('diamond_final_price')->default(0);

            // Optional
            $table->text('remark')->nullable();

            $table->timestamps();

            // Foreign Keys
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
        Schema::dropIfExists('sell_diamond_items');
    }
};
