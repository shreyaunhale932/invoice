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
        Schema::create('retail_purchase_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable()->index();
            $table->unsignedBigInteger('firm_id')->nullable()->index();
            $table->foreignId('retail_purchase_id')->constrained('retail_purchases')->cascadeOnDelete();

            $table->unsignedBigInteger('product_id')->nullable()->index();
            $table->unsignedBigInteger('item_product_data_id')->nullable()->index();
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->unsignedBigInteger('subcategory_id')->nullable()->index();
            $table->unsignedBigInteger('purity_id')->nullable()->index();

            $table->string('item_name');
            $table->string('pre_code')->nullable();
            $table->string('post_code')->nullable();
            $table->string('barcode')->nullable();

            $table->decimal('quantity', 10, 2)->default(1);
            $table->string('unit')->default('GM');
            $table->string('size')->nullable();

            $table->decimal('gross_weight', 12, 3)->default(0);
            $table->decimal('stone_weight', 12, 3)->default(0);
            $table->decimal('diamond_weight', 12, 3)->default(0);
            $table->decimal('net_weight', 12, 3)->default(0);
            $table->decimal('wastage_percent', 8, 2)->default(0);
            $table->decimal('final_fn_weight', 12, 3)->default(0);

            $table->decimal('purchase_rate', 15, 2)->default(0);
            $table->decimal('metal_amount', 15, 2)->default(0);
            $table->decimal('making_price', 15, 2)->default(0);
            $table->string('making_type')->nullable();
            $table->decimal('making_final_amount', 15, 2)->default(0);
            $table->decimal('stone_amount', 15, 2)->default(0);
            $table->decimal('diamond_amount', 15, 2)->default(0);

            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('gst_percent', 8, 2)->default(0);
            $table->decimal('gst_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_purchase_items');
    }
};
