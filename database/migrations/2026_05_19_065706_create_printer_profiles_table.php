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
        Schema::create('printer_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('dpi')->default(203);
            $table->decimal('label_width', 8, 2); // in mm
            $table->decimal('label_height', 8, 2); // in mm
            $table->decimal('margin_top', 8, 2)->default(0);
            $table->decimal('margin_bottom', 8, 2)->default(0);
            $table->decimal('margin_left', 8, 2)->default(0);
            $table->decimal('margin_right', 8, 2)->default(0);
            $table->string('orientation')->default('portrait');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printer_profiles');
    }
};
