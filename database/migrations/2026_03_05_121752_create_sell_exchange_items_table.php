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
        Schema::create('sell_exchange_items', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->unsignedBigInteger('sell_invoice_id');
            $blueprint->unsignedBigInteger('admin_id');
            $blueprint->unsignedBigInteger('firm_id');
            $blueprint->string('description')->nullable();
            $blueprint->string('metal')->nullable();
            $blueprint->string('purity')->nullable();
            $blueprint->decimal('gross_weight', 15, 3)->default(0);
            $blueprint->decimal('less_weight', 15, 3)->default(0);
            $blueprint->decimal('net_weight', 15, 3)->default(0);
            $blueprint->decimal('fine_weight', 15, 3)->default(0);
            $blueprint->decimal('wanted_amt', 15, 2)->default(0);
            $blueprint->decimal('rate', 15, 2)->default(0);
            $blueprint->decimal('amount', 15, 2)->default(0);
            $blueprint->timestamps();

            // Index
            $blueprint->index('sell_invoice_id');
            $blueprint->index('admin_id');
            $blueprint->index('firm_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_exchange_items');
    }
};
