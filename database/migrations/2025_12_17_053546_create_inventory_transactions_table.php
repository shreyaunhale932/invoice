<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();

            // Relation
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();

            // IN or OUT
            $table->enum('type', ['IN', 'OUT']);

            // Quantity / Weight
            $table->decimal('gross_weight');

            // Unit (PCS / GM / MG)
            $table->string('unit')->default('GM');

            // Optional note
            $table->string('remarks')->nullable();

            // User who performed action
            $table->foreignId('admin_id')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
