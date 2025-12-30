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
        Schema::table('metal_rates', function (Blueprint $table) {
            $table->string('purity_type')
                  ->after('metal_type')   // change position if needed
                  ->nullable()
                  ->comment('percent | karat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('metal_rates', function (Blueprint $table) {
            $table->dropColumn('purity_type');
        });
    }
};
