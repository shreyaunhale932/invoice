<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packet_masters', function (Blueprint $table) {

            // Remove unique index
            $table->dropUnique(['packet_no']);

        });
    }

    public function down(): void
    {
        Schema::table('packet_masters', function (Blueprint $table) {

            // Add unique index again
            $table->unique('packet_no');

        });
    }
};
