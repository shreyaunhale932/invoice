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
        Schema::create('karigar_receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable()->index();
            $table->unsignedBigInteger('firm_id')->nullable()->index();
            $table->unsignedBigInteger('customer_order_id')->index();
            $table->unsignedBigInteger('karigar_assignment_id')->index();
            $table->unsignedBigInteger('karigar_id')->index();
            $table->string('receipt_no')->index();
            $table->date('received_date');
            $table->decimal('finished_gross_weight', 12, 3)->default(0);
            $table->decimal('finished_net_weight', 12, 3)->default(0);
            $table->decimal('stones_weight', 12, 3)->default(0);
            $table->integer('stones_pieces')->default(0);
            $table->decimal('scrap_metal_returned', 12, 3)->default(0);
            $table->string('scrap_purity')->nullable();
            $table->decimal('actual_wastage', 12, 3)->default(0);
            $table->decimal('wastage_difference', 12, 3)->default(0);
            $table->decimal('final_making_charges', 15, 2)->default(0);
            $table->decimal('other_charges', 15, 2)->default(0);
            $table->decimal('total_making_charges', 15, 2)->default(0);
            $table->string('payment_status')->default('unpaid');
            $table->date('payment_date')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('huid')->nullable();
            $table->string('qc_status')->default('passed');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karigar_receipts');
    }
};
