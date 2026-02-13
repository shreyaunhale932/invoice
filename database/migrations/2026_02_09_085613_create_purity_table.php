<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('purity')) {
            Schema::create('purity', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('admin_id');
                $table->decimal('purity_value', 10, 3);
                $table->enum('purity_type', ['karat', 'percent'])->default('karat');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('purity');
    }
};
