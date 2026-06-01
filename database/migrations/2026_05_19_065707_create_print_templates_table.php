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
        Schema::create('print_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable();
            $table->foreignId('printer_profile_id')->nullable()->constrained('printer_profiles')->nullOnDelete();
            $table->decimal('canvas_width', 8, 2)->nullable();
            $table->decimal('canvas_height', 8, 2)->nullable();
            $table->boolean('is_default')->default(false);
            $table->json('settings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_templates');
    }
};
