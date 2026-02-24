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
        Schema::table('sell_invoices', function (Blueprint $table) {
            $table->decimal('total_making_charge', 15, 2)->default(0)->after('stone_total_amount');
            $table->decimal('making_discount_percent', 15, 2)->default(0)->after('total_making_charge');
            $table->decimal('making_discount_amount', 15, 2)->default(0)->after('making_discount_percent');
            $table->decimal('total_diamond_stone_packet', 15, 2)->default(0)->after('making_discount_amount');
            $table->decimal('diamond_discount_percent', 15, 2)->default(0)->after('total_diamond_stone_packet');
            $table->decimal('diamond_discount_amount', 15, 2)->default(0)->after('diamond_discount_percent');
            $table->decimal('diamond_total_amount', 15, 2)->default(0)->after('diamond_discount_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sell_invoices', function (Blueprint $table) {
            $table->dropColumn([
                'total_making_charge',
                'making_discount_percent',
                'making_discount_amount',
                'total_diamond_stone_packet',
                'diamond_discount_percent',
                'diamond_discount_amount',
                'diamond_total_amount',
            ]);
        });
    }
};
