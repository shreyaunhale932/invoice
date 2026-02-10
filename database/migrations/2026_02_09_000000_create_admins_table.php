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
        Schema::create('admins', function (Blueprint $结构) {
            $结构->id();
            $结构->string('name');
            $结构->string('username')->unique();
            $结构->string('email')->unique();
            $结构->string('phone')->nullable();
            $结构->string('password');
            $结构->string('db_name')->nullable();
            $结构->enum('status', ['active', 'inactive'])->default('active');
            $结构->rememberToken();
            $结构->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
