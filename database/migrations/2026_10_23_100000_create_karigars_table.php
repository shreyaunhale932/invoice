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
        Schema::create('karigars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable()->index();
            $table->unsignedBigInteger('firm_id')->nullable()->index();
            $table->string('code')->nullable()->index();
            $table->string('name');
            $table->string('shop_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('speciality')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('adhar_card')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->decimal('opening_metal_balance', 12, 3)->default(0);
            $table->decimal('opening_amount_balance', 15, 2)->default(0);
            $table->decimal('current_metal_balance', 12, 3)->default(0);
            $table->string('status')->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karigars');
    }
};
