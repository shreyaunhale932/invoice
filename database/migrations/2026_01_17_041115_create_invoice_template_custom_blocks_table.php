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
        Schema::dropIfExists('invoice_template_custom_blocks');
        
        Schema::create('invoice_template_custom_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('block_name');
            $table->string('block_type')->default('custom'); // 'custom', 'info', 'image', 'mixed'
            $table->text('content')->nullable(); // HTML content or text
            $table->string('image_path')->nullable();
            $table->string('position')->default('before_footer'); // 'before_footer', 'after_items', 'after_header', 'custom'
            $table->integer('display_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->text('css_class')->nullable();
            $table->text('custom_css')->nullable();
            $table->timestamps();

            $table->index(['admin_id', 'position', 'display_order'], 'custom_blocks_admin_pos_order_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_template_custom_blocks');
    }
};
