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
        Schema::create('karigar_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable()->index();
            $table->unsignedBigInteger('firm_id')->nullable()->index();
            $table->unsignedBigInteger('customer_order_id')->index();
            $table->unsignedBigInteger('karigar_id')->index();
            $table->string('assignment_no')->index();
            $table->date('assigned_date');
            $table->date('expected_delivery_date')->nullable();
            $table->string('metal_issued_type')->nullable();
            $table->decimal('metal_issued_weight', 12, 3)->default(0);
            $table->string('metal_issued_purity')->nullable();
            $table->decimal('stones_issued_weight', 12, 3)->default(0);
            $table->integer('stones_issued_pieces')->default(0);
            $table->string('stones_issued_description')->nullable();
            $table->string('making_charge_type')->default('per_gram');
            $table->decimal('making_charge_rate', 15, 2)->default(0);
            $table->decimal('allowed_wastage_percent', 6, 2)->default(0);
            $table->decimal('allowed_wastage_weight', 12, 3)->default(0);
            $table->string('status')->default('assigned');
            $table->text('instructions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karigar_assignments');
    }
};
