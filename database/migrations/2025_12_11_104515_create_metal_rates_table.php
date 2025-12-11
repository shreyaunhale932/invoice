<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::create('metal_rates', function (Blueprint $table) {
        $table->id();
        $table->string('metal_type'); // Gold / Silver / Platinum
        $table->decimal('price_per_gram', 10, 2);
        $table->decimal('gram', 10, 3)->nullable();
        $table->string('karat')->nullable(); // e.g. 14k, 18k
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metal_rates');
    }
};
