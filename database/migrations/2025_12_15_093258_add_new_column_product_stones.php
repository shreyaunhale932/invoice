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
        Schema::table('product_stones', function (Blueprint $table) {
            $table->decimal('stone_final_price')
                  ->nullable()
                  ->after('stone_price'); // change 'stone_price' if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_stones', function (Blueprint $table) {
            $table->dropColumn('stone_final_price');
        });
    }
};
