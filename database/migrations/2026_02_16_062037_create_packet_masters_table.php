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
        Schema::create('packet_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firm_id');
            $table->string('packet_no')->unique(); // Unique

            // Foreign Keys for Packet Attributes (Nullable)
            $table->unsignedBigInteger('stone_id')->nullable();
            $table->unsignedBigInteger('clarity_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('cut_id')->nullable();
            $table->unsignedBigInteger('shape_id')->nullable();
            $table->unsignedBigInteger('mm_id')->nullable();
            $table->unsignedBigInteger('chalni_id')->nullable();

            $table->string('certificate_no')->nullable();
            $table->decimal('rate_retail', 15, 2)->nullable();
            $table->decimal('rate_wholesale', 15, 2)->nullable();
            $table->decimal('cost', 15, 2)->nullable();
            $table->decimal('average_pcs', 10, 2)->nullable();
            $table->decimal('average_wt', 10, 3)->nullable();
            $table->boolean('solitaire')->default(false)->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Foreign Key Constraints
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');
            $table->foreign('stone_id')->references('id')->on('stones')->onDelete('set null');
            $table->foreign('clarity_id')->references('id')->on('clarities')->onDelete('set null');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');
            $table->foreign('cut_id')->references('id')->on('cuts')->onDelete('set null');
            $table->foreign('shape_id')->references('id')->on('shapes')->onDelete('set null');
            $table->foreign('mm_id')->references('id')->on('mms')->onDelete('set null');
            $table->foreign('chalni_id')->references('id')->on('chalnis')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packet_masters');
    }
};
