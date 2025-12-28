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
        Schema::create('item_product_data', function (Blueprint $table) {
            $table->id();
        $table->string('product_code')->unique();
        $table->string('barcode')->nullable();
        $table->string('product_name');

        // Category relations
        $table->unsignedBigInteger('category_id')->nullable();
        $table->unsignedBigInteger('subcategory_id')->nullable();
        $table->unsignedBigInteger('purity_id')->nullable();

        // Metal Rate Info
        $table->decimal('metal_rate', 10, 2)->nullable();

        // HSN
        $table->string('hsn_code')->nullable();

        // Purity / Weight
        $table->string('gold_purity')->nullable();
        $table->decimal('gross_weight', 10, 3)->nullable();
        $table->decimal('net_weight', 10, 3)->nullable();

        // Diamond & Stones
        $table->decimal('diamond_weight', 10, 3)->nullable();
        $table->decimal('stone_weight', 10, 3)->nullable();

        // Pricing
        $table->decimal('wastage_percent', 10, 2)->nullable();
        $table->decimal('making_price', 10, 2)->nullable();
        $table->decimal('gst_percent', 10, 2)->nullable();
        $table->decimal('gst_amount', 10, 2)->nullable();
        $table->decimal('gold_price', 10, 2)->nullable();
        $table->decimal('mrp_price', 12, 2)->nullable();

        $table->timestamps();

        // Foreign keys
        $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');
        $table->foreign('subcategory_id')->references('subcategory_id')->on('subcategories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_product_data');
    }
};
