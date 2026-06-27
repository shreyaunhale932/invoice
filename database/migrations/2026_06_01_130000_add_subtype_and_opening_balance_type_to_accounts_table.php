<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            if (!Schema::hasColumn('accounts', 'sub_type')) {
                $table->string('sub_type')->default('normal');
            }
            if (!Schema::hasColumn('accounts', 'opening_balance_type')) {
                $table->string('opening_balance_type')->default('dr');
            }
            if (!Schema::hasColumn('accounts', 'is_system')) {
                $table->boolean('is_system')->default(false);
            }
        });

        // Set all existing accounts as system accounts
        DB::table('accounts')->update(['is_system' => true]);

        // For existing accounts, set their opening balance type based on their group type
        $groups = DB::table('account_groups')->get();
        foreach ($groups as $group) {
            $type = $group->type;
            if (in_array($type, ['Asset', 'Expense'])) {
                DB::table('accounts')
                    ->where('account_group_id', $group->id)
                    ->update(['opening_balance_type' => 'dr']);
            } else {
                DB::table('accounts')
                    ->where('account_group_id', $group->id)
                    ->update(['opening_balance_type' => 'cr']);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn(['sub_type', 'opening_balance_type', 'is_system']);
        });
    }
};
