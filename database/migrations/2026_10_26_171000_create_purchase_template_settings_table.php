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
        if (!Schema::hasTable('purchase_template_settings')) {
            Schema::create('purchase_template_settings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('admin_id')->nullable();
                $table->unsignedBigInteger('firm_id')->nullable();
                $table->string('section_key'); // e.g., 'purchase_header', 'purchase_meta', 'supplier_info', 'purchase_item_table', etc.
                $table->string('field_key'); // e.g., 'purchase_no', 'column_item_desc'
                $table->string('label')->nullable(); // Display label
                $table->boolean('is_visible')->default(true);
                $table->integer('display_order')->default(0);
                $table->string('field_type')->nullable(); // 'label', 'column', 'section', 'image', 'text', 'textarea'
                $table->text('default_value')->nullable();
                $table->text('value')->nullable(); // For storing image paths, custom texts, etc.
                $table->timestamps();

                $table->index(['admin_id', 'section_key']);
                $table->index(['admin_id', 'firm_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_template_settings');
    }
};
