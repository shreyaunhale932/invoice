<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sell_packet_items', function (Blueprint $table) {
            $table->id();

            // 🔹 Invoice References
            $table->unsignedBigInteger('sell_invoice_id');
            $table->unsignedBigInteger('sell_invoice_item_id');

            // 🔹 Packet Details
            $table->string('packet_no')->nullable();
            $table->integer('pcs')->nullable();

            $table->string('stone')->nullable();
            $table->string('clarity')->nullable();
            $table->string('color')->nullable();
            $table->string('cut')->nullable();
            $table->string('shape_')->nullable();
            $table->string('chain')->nullable();
            $table->string('mm')->nullable();


            $table->boolean('solitaire')->default(0);

            $table->decimal('rate', 15, 2)->nullable();
            $table->decimal('amount', 15, 2)->default(0.00);

            $table->decimal('weight', 10, 3)->nullable();
            $table->decimal('wt_in_gram', 10, 3)->nullable();

            $table->string('uom')->nullable();
            $table->string('certificate_no')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // 🔹 Foreign Keys (Optional – if needed)
            $table->foreign('sell_invoice_id')
                ->references('id')
                ->on('sell_invoices')
                ->onDelete('cascade');

            $table->foreign('sell_invoice_item_id')
                ->references('id')
                ->on('sell_invoice_items')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sell_packet_items');
    }
};
