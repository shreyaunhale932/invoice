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
        Schema::create('invoice_template_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('section_key'); // e.g., 'customer_details', 'billing_address', 'item_table'
            $table->string('field_key'); // e.g., 'customer_name_label', 'category_column'
            $table->string('label')->nullable(); // Display label
            $table->boolean('is_visible')->default(true);
            $table->integer('display_order')->default(0);
            $table->string('field_type')->nullable(); // 'label', 'column', 'section', 'image', 'text'
            $table->text('default_value')->nullable();
            $table->text('value')->nullable(); // For storing image paths, text content, etc.
            $table->timestamps();

            // Unique constraint on combination of admin_id, section_key, and field_key
            $table->unique(['admin_id', 'section_key', 'field_key'], 'unique_template_setting');
            $table->index(['admin_id', 'section_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_template_settings');
    }
};
