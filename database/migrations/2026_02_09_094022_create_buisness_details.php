<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('business_details')) {
            Schema::create('business_details', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');

                $table->string('business_name', 255)->nullable();
                $table->string('logo', 255)->nullable();
                $table->string('gstin', 15)->nullable();
                $table->string('pan', 10)->nullable();
                $table->text('address')->nullable();

                $table->string('country', 50)->nullable();
                $table->string('state', 50)->nullable();
                $table->string('city', 50)->nullable();
                $table->string('postalcode', 6)->nullable();

                $table->string('contact_number', 20)->nullable();
                $table->string('email', 255)->nullable();

                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')
                    ->useCurrent()
                    ->useCurrentOnUpdate();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('business_details');
    }
};
