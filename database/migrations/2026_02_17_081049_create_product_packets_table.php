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
        Schema::create('product_packets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('packet_master_id')->nullable(); 
            $table->string('packet_no')->nullable();
            
            // Attributes (Snapshot from PacketMaster or Manual Entry)
            $table->unsignedBigInteger('stone_id')->nullable();
            $table->unsignedBigInteger('clarity_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('cut_id')->nullable();
            $table->unsignedBigInteger('shape_id')->nullable();
            $table->unsignedBigInteger('chalni_id')->nullable();
            $table->unsignedBigInteger('mm_id')->nullable();

            $table->boolean('solitaire')->default(false)->nullable();
            $table->decimal('rate', 15, 2)->nullable();
            $table->decimal('weight', 10, 3)->nullable(); // wt
            $table->string('certificate_no')->nullable();
            
            $table->timestamps();

            // Foreign Keys
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('packet_master_id')->references('id')->on('packet_masters')->onDelete('set null');
            
             // Attribute Foreign Keys
            $table->foreign('stone_id')->references('id')->on('stones')->onDelete('set null');
            $table->foreign('clarity_id')->references('id')->on('clarities')->onDelete('set null');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');
            $table->foreign('cut_id')->references('id')->on('cuts')->onDelete('set null');
            $table->foreign('shape_id')->references('id')->on('shapes')->onDelete('set null');
            $table->foreign('chalni_id')->references('id')->on('chalnis')->onDelete('set null');
            $table->foreign('mm_id')->references('id')->on('mms')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_packets');
    }
};
