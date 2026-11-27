<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('admin_subscription_id')
                ->constrained('admin_subscriptions')
                ->restrictOnDelete();

            $table->string('cashfree_payment_id')->nullable()->unique();

            $table->string('payment_type')->nullable();

            $table->decimal('amount', 10, 2)->default(0);

            $table->string('currency', 3)->default('INR');

            $table->string('status')->default('pending');

            $table->string('payment_method')->nullable();

            $table->timestamp('paid_at')->nullable();

            $table->string('webhook_event_id')->nullable()->unique();

            $table->json('webhook_payload')->nullable();

            $table->timestamps();

            $table->index(['admin_subscription_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_payments');
    }
};
