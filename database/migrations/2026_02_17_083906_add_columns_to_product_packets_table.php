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
        Schema::table('product_packets', function (Blueprint $table) {
            $table->integer('pcs')->nullable()->after('packet_no');
            $table->decimal('wt_in_gram', 10, 3)->nullable()->after('weight');
            $table->string('uom')->nullable()->after('wt_in_gram'); // PCS, CT, WT
            $table->decimal('amount', 15, 2)->default(0)->after('rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_packets', function (Blueprint $table) {
            $table->dropColumn(['pcs', 'wt_in_gram', 'uom', 'amount']);
        });
    }
};
