<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('product_stones', function (Blueprint $table) {
            $table->id('stone_id');
            $table->unsignedBigInteger('product_id');

            $table->string('stone_name');
            $table->decimal('stone_weight', 10, 3)->nullable();
            $table->decimal('stone_price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();   // If applied

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stones');
    }
};
