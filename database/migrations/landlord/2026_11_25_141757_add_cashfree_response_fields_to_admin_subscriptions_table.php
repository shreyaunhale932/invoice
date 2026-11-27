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
        Schema::table('admin_subscriptions', function (Blueprint $table) {
            // Cashfree's internal subscription ID
            $table->string('cf_subscription_id')->nullable()->unique();

            // Checkout session returned by Cashfree
            $table->text('subscription_session_id')->nullable();

            // Cashfree's subscription status (INITIALIZED, ACTIVE, etc.)
            $table->string('cashfree_status')->nullable();

            // Authorization status
            $table->string('authorization_status')->nullable();

            // Next scheduled payment date
            $table->timestamp('next_schedule_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('admin_subscriptions', function (Blueprint $table) {
            $table->dropUnique(['cf_subscription_id']);

            $table->dropColumn([
                'cf_subscription_id',
                'subscription_session_id',
                'cashfree_status',
                'authorization_status',
                'next_schedule_date',
            ]);
        });
    }
};
