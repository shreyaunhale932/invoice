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
        Schema::create('sell_exchange_diamonds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sell_invoice_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('firm_id');
            $table->string('description')->nullable();
            $table->string('clarity')->nullable();
            $table->string('cut')->nullable();
            $table->string('color')->nullable();
            $table->integer('pieces')->default(0);
            $table->decimal('weight', 15, 3)->default(0);
            $table->decimal('rate', 15, 2)->default(0);
            $table->decimal('amount', 15, 2)->default(0);
            $table->timestamps();

            // Index
            $table->index('sell_invoice_id');
            $table->index('admin_id');
            $table->index('firm_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_exchange_diamonds');
    }
};
