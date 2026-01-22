<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('inventory_transactions', function (Blueprint $table) {
            $table->decimal('net_weight', 10, 3)->change();
            $table->decimal('gross_weight', 10, 3)->change();
        });
    }

    public function down(): void
    {
        Schema::table('inventory_transactions', function (Blueprint $table) {
            $table->decimal('net_weight', 10, 2)->change();
            $table->decimal('gross_weight', 10, 2)->change();
        });
    }
};
