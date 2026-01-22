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
        // 1. Account Groups
        Schema::create('account_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Asset', 'Liability', 'Equity', 'Income', 'Expense']);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('account_groups')->onDelete('cascade');
        });

        // 2. Accounts
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->foreignId('account_group_id')->constrained('account_groups');
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->timestamps();
        });

        // 3. Journal Entries
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->date('entry_date');
            $table->string('narration')->nullable();
            $table->string('reference_type')->nullable(); // e.g., 'SellInvoice', 'InventoryTransaction'
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->timestamps();
        });

        // 4. Journal Entry Lines
        Schema::create('journal_entry_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_entry_id')->constrained('journal_entries')->onDelete('cascade');
            $table->foreignId('account_id')->constrained('accounts');
            $table->decimal('debit', 15, 2)->default(0);
            $table->decimal('credit', 15, 2)->default(0);
            $table->string('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entry_lines');
        Schema::dropIfExists('journal_entries');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('account_groups');
    }
};
