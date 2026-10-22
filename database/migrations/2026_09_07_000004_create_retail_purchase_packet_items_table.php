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
        if (!Schema::hasTable('retail_purchase_packet_items')) {
            Schema::create('retail_purchase_packet_items', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('admin_id')->nullable()->index();
                $table->unsignedBigInteger('firm_id')->nullable()->index();

                $table->foreignId('retail_purchase_id')->constrained('retail_purchases')->cascadeOnDelete();
                $table->foreignId('retail_purchase_item_id')->constrained('retail_purchase_items')->cascadeOnDelete();

                $table->string('packet_no')->nullable();
                $table->string('packet_type')->default('Diamond');
                $table->integer('pcs')->nullable();

                $table->string('stone')->nullable();
                $table->string('clarity')->nullable();
                $table->string('color')->nullable();
                $table->string('cut')->nullable();
                $table->string('shape')->nullable();
                $table->string('mm')->nullable();
                $table->string('chalni')->nullable();

                $table->boolean('solitaire')->default(0);

                $table->decimal('rate', 15, 2)->nullable();
                $table->decimal('amount', 15, 2)->default(0.00);

                $table->decimal('weight', 10, 3)->nullable();
                $table->decimal('wt_in_gram', 10, 3)->nullable();

                $table->string('uom')->nullable();
                $table->string('certificate_no')->nullable();

                $table->timestamps();
            });
        }

        // Add packet_amount to retail_purchase_items if not present
        if (!Schema::hasColumn('retail_purchase_items', 'packet_amount')) {
            Schema::table('retail_purchase_items', function (Blueprint $table) {
                $table->decimal('packet_amount', 15, 2)->default(0)->after('stone_amount');
                $table->decimal('packet_weight', 12, 3)->default(0)->after('stone_weight');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_purchase_packet_items');
        if (Schema::hasColumn('retail_purchase_items', 'packet_amount')) {
            Schema::table('retail_purchase_items', function (Blueprint $table) {
                $table->dropColumn(['packet_amount', 'packet_weight']);
            });
        }
    }
};
