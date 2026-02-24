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
        Schema::table('item_product_data', function (Blueprint $table) {

            // Making Type (e.g. percentage / fixed)
            $table->string('making_type')->nullable()->after('making_price');

            // Making Final Amount
            $table->decimal('making_final_amount', 15, 2)->default(0)->after('making_type');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_product_data', function (Blueprint $table) {
            $table->dropColumn(['making_type', 'making_final_amount']);
        });
    }
};
