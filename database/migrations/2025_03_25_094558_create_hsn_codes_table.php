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
        Schema::create('hsn_codes', function (Blueprint $table) {
            $table->id();
            $table->string('hsn_code', 10)->unique(); // HSN code (max 10 chars)
            $table->string('description', 255); // Description of the item
            $table->decimal('gst_rate', 5, 2)->unsigned(); // GST Rate (e.g., 18.00)
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hsn_codes');
    }
};
