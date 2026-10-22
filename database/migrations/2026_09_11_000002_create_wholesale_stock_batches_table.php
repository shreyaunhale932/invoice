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
        if (!Schema::hasTable('wholesale_stock_batches')) {
            Schema::create('wholesale_stock_batches', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('admin_id')->nullable()->index();
                $table->unsignedBigInteger('firm_id')->nullable()->index();
                $table->foreignId('wholesale_stock_id')->constrained('wholesale_stocks')->cascadeOnDelete();
                $table->foreignId('retail_purchase_id')->constrained('retail_purchases')->cascadeOnDelete();
                $table->foreignId('retail_purchase_item_id')->constrained('retail_purchase_items')->cascadeOnDelete();
                $table->unsignedBigInteger('supplier_id')->nullable()->index();

                $table->date('purchase_date');
                $table->decimal('purchase_rate', 15, 2)->default(0);
                $table->decimal('making_price', 15, 2)->default(0);
                $table->string('making_type')->nullable();

                $table->decimal('initial_quantity', 10, 2)->default(0);
                $table->decimal('remaining_quantity', 10, 2)->default(0);

                $table->decimal('initial_gross_weight', 12, 3)->default(0);
                $table->decimal('remaining_gross_weight', 12, 3)->default(0);

                $table->decimal('initial_net_weight', 12, 3)->default(0);
                $table->decimal('remaining_net_weight', 12, 3)->default(0);

                $table->decimal('initial_fine_weight', 12, 3)->default(0);
                $table->decimal('remaining_fine_weight', 12, 3)->default(0);

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wholesale_stock_batches');
    }
};
