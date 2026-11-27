
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_subscriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('admin_id')
                ->constrained('admins')
                ->restrictOnDelete();

            // Plan details
            $table->string('plan_name');
            $table->string('billing_cycle');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('INR');

            // Cashfree references
            $table->string('cashfree_plan_id')->nullable();
            $table->string('cashfree_subscription_id')
                ->nullable()
                ->unique();

            // Subscription status
            $table->string('status')->default('pending');

            // Subscription dates
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();

            $table->index(['admin_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_subscriptions');
    }
};
