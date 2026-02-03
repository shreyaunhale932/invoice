<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('item_product_data', function (Blueprint $table) {
            $table->decimal('final_price', 15, 2)->after('gold_price')->nullable();
            $table->decimal('final_fn_weight', 10, 3)->after('net_weight')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('item_product_data', function (Blueprint $table) {
            $table->dropColumn(['final_price', 'final_fn_weight']);
        });
    }
};
