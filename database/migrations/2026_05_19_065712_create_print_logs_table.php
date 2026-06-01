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
        Schema::create('print_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->nullable()->constrained('print_templates')->nullOnDelete();
            $table->string('entity_type')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->string('status')->default('queued');
            $table->text('error')->nullable();
            $table->integer('copies')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_logs');
    }
};
