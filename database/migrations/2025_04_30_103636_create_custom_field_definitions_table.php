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
        Schema::create('custom_field_definitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->string('model_type'); // 'invoice' or 'invoice_item'
            $table->string('field_key');  // e.g. 'category', 'po_number'
            $table->string('field_label'); // For UI display
            $table->string('field_type')->default('text'); // e.g. text, number, date, etc.
            $table->timestamps();
        
            $table->unique(['admin_id', 'model_type', 'field_key']); // Prevent duplicates
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_field_definitions');
    }
};
