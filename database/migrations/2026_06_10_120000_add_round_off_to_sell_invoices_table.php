<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('sell_invoices', 'round_off')) {
            Schema::table('sell_invoices', function (Blueprint $table) {
                $table->decimal('round_off', 10, 2)->default(0)->after('final_amount');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('sell_invoices', 'round_off')) {
            Schema::table('sell_invoices', function (Blueprint $table) {
                $table->dropColumn('round_off');
            });
        }
    }
};
