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
        if (Schema::hasTable('packet_masters') && !Schema::hasColumn('packet_masters', 'packet_type')) {
            Schema::table('packet_masters', function (Blueprint $table) {
                $table->string('packet_type')->default('Diamond')->nullable()->after('solitaire');
            });
        }

        if (Schema::hasTable('product_packets') && !Schema::hasColumn('product_packets', 'packet_type')) {
            Schema::table('product_packets', function (Blueprint $table) {
                $table->string('packet_type')->default('Diamond')->nullable()->after('solitaire');
            });
        }

        if (Schema::hasTable('sell_packet_items') && !Schema::hasColumn('sell_packet_items', 'packet_type')) {
            Schema::table('sell_packet_items', function (Blueprint $table) {
                $table->string('packet_type')->default('Diamond')->nullable()->after('solitaire');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('packet_masters') && Schema::hasColumn('packet_masters', 'packet_type')) {
            Schema::table('packet_masters', function (Blueprint $table) {
                $table->dropColumn('packet_type');
            });
        }

        if (Schema::hasTable('product_packets') && Schema::hasColumn('product_packets', 'packet_type')) {
            Schema::table('product_packets', function (Blueprint $table) {
                $table->dropColumn('packet_type');
            });
        }

        if (Schema::hasTable('sell_packet_items') && Schema::hasColumn('sell_packet_items', 'packet_type')) {
            Schema::table('sell_packet_items', function (Blueprint $table) {
                $table->dropColumn('packet_type');
            });
        }
    }
};
