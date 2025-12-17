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
        Schema::table('products', function (Blueprint $table) {

            // Sale Price
            $table->decimal('sale_price')
                  ->nullable()
                  ->after('net_weight');

            // Gross Weight Unit
            $table->enum('gross_weight_unit', ['GM', 'MG', 'KG'])
                  ->default('GM')
                  ->after('gross_weight');

            // Net Weight Unit
            $table->enum('net_weight_unit', ['GM', 'MG', 'KG'])
                  ->default('GM')
                  ->after('net_weight');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'sale_price',
                'gross_weight_unit',
                'net_weight_unit'
            ]);
        });
    }
};
