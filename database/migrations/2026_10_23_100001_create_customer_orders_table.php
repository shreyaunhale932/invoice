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
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable()->index();
            $table->unsignedBigInteger('firm_id')->nullable()->index();
            $table->unsignedBigInteger('customer_id')->nullable()->index();
            $table->string('order_no')->index();
            $table->date('order_date');
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('karigar_id')->nullable()->index();
            $table->string('status')->default('pending')->index();
            $table->string('priority')->default('normal');
            $table->string('item_name');
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->unsignedBigInteger('subcategory_id')->nullable()->index();
            $table->string('metal_type')->default('Gold');
            $table->string('purity')->nullable();
            $table->decimal('expected_gross_weight', 12, 3)->default(0);
            $table->decimal('expected_net_weight', 12, 3)->default(0);
            $table->string('size')->nullable();
            $table->string('design_code')->nullable();
            $table->string('image')->nullable();
            $table->text('specifications')->nullable();
            $table->decimal('estimated_rate', 15, 2)->default(0);
            $table->decimal('estimated_making_charges', 15, 2)->default(0);
            $table->decimal('estimated_other_charges', 15, 2)->default(0);
            $table->decimal('estimated_total_amount', 15, 2)->default(0);
            $table->decimal('advance_amount', 15, 2)->default(0);
            $table->decimal('advance_metal_weight', 12, 3)->default(0);
            $table->string('advance_payment_mode')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_orders');
    }
};
