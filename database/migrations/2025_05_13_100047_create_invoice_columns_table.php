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
        Schema::create('invoice_columns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // 'text', 'number', 'formula'
            $table->boolean('is_custom')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->integer('position')->default(0);
            $table->timestamps();
        });

        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_columns');
    }
};
