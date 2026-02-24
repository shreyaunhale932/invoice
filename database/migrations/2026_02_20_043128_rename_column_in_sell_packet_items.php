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
        Schema::table('sell_packet_items', function (Blueprint $table) {
            $table->renameColumn('chain', 'chalni');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sell_packet_items', function (Blueprint $table) {
            $table->renameColumn('chalni', 'chain');
        });
    }
};
