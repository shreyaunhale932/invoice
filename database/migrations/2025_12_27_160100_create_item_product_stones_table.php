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
        Schema::create('item_product_stones', function (Blueprint $table) {
            $table->id('stone_id');
            $table->unsignedBigInteger('item_product_data_id');

            $table->string('stone_name');
            $table->decimal('stone_weight', 10, 3)->nullable();
            $table->decimal('stone_price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();   // If applied
            $table->decimal('stone_final_price')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();

            $table->timestamps();

            $table->foreign('item_product_data_id')->references('id')->on('item_product_data')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_product_stones');
    }
};

