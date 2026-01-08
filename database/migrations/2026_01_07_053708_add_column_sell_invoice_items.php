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
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            $table->string('pre_code')->nullable()->after('product_id');
            $table->string('post_code')->nullable()->after('pre_code');
            $table->string('barcode')->nullable()->after('post_code');
            $table->decimal('making_price')->default(0)->after('barcode');
            $table->decimal('final_price')->default(0)->after('making_price');
             $table->decimal('gst_amount')->default(0)->after('final_price');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sell_invoice_items', function (Blueprint $table) {
            $table->dropColumn([
                'pre_code',
                'post_code',
                'barcode',
                'making_price',
                'final_price'
            ]);
        });
    }
};
