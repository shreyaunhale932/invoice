<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // change metal_rate from decimal to unsignedBigInteger
            $table->unsignedBigInteger('metal_rate')->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // revert back to decimal if rollback
            $table->decimal('metal_rate', 10, 2)->change();
        });
    }
};
