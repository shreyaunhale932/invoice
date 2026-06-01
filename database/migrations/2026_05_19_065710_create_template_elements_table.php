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
        Schema::create('template_elements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('print_templates')->cascadeOnDelete();
            $table->string('type');
            $table->text('value')->nullable();
            $table->decimal('pos_x', 8, 2);
            $table->decimal('pos_y', 8, 2);
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->json('styles')->nullable();
            $table->json('settings')->nullable();
            $table->integer('z_index')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_elements');
    }
};
