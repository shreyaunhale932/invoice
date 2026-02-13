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
        Schema::create('firms', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('name');
            $blueprint->string('logo')->nullable();
            $blueprint->string('gstin')->nullable();
            $blueprint->string('pan')->nullable();
            $blueprint->string('email')->nullable();
            $blueprint->string('phone')->nullable();
            $blueprint->text('address')->nullable();
            $blueprint->string('country')->nullable();
            $blueprint->string('state')->nullable();
            $blueprint->string('city')->nullable();
            $blueprint->string('postalcode')->nullable();
            $blueprint->boolean('is_default')->default(false);
            $blueprint->string('status')->default('active');
            $blueprint->timestamps();
            $blueprint->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firms');
    }
};
