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
          Schema::table('diamond_details', function (Blueprint $table) {
            $table->decimal('diamond_weight')->nullable()->after('color');
            $table->decimal('diamond_final_price')->nullable()->after('diamond_weight');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diamond_details', function (Blueprint $table) {
            $table->dropColumn(['diamond_weight', 'diamond_final_price']);
        });
    }
};
