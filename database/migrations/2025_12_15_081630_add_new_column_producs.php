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
            $table->string('gold_color')->nullable()->after('net_weight');
            // You can change `after()` column as per your table structure
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('gold_color');
        });
    }
};
