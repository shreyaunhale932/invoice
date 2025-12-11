<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**php artisan migrate:refresh --path=database/migrations/2025_04_30_133232_create_custom_field_values_table.php
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_field_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_field_definition_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('model_id'); // ID of invoice or invoice_item
            $table->string('model_type');           // 'App\Models\Invoice' or 'App\Models\InvoiceItem'
            $table->text('value')->nullable();
            $table->timestamps();
        
            $table->index(['model_id', 'model_type']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_field_values');
    }
};
