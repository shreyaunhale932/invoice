<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('item_product_data', function (Blueprint $table) {
            $table->decimal('sale_price')
                  ->nullable()
                  ->after('mrp_price'); // adjust column position if needed
        });
    }

    public function down(): void
    {
        Schema::table('item_product_data', function (Blueprint $table) {
            $table->dropColumn('sale_price');
        });
    }
};
