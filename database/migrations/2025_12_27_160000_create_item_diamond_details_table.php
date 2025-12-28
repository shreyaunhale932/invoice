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
        Schema::create('item_diamond_details', function (Blueprint $table) {
            $table->id('diamond_id');
            $table->unsignedBigInteger('item_product_data_id');

            $table->string('clarity')->nullable();
            $table->string('cut')->nullable();
            $table->string('color')->nullable();
            $table->integer('pieces')->nullable();
            $table->decimal('price_per_carat', 10, 2)->nullable();
            $table->decimal('total_price', 12, 2)->nullable();
            $table->decimal('diamond_weight')->nullable();
            $table->decimal('diamond_final_price')->nullable();

            $table->timestamps();

            $table->foreign('item_product_data_id')->references('id')->on('item_product_data')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_diamond_details');
    }
};

