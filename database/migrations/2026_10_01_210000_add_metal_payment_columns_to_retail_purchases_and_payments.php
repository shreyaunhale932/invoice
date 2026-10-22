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
        if (Schema::hasTable('retail_purchases')) {
            Schema::table('retail_purchases', function (Blueprint $table) {
                if (!Schema::hasColumn('retail_purchases', 'gold_payment_grams')) {
                    $table->decimal('gold_payment_grams', 15, 3)->default(0)->after('payment_method');
                }
                if (!Schema::hasColumn('retail_purchases', 'gold_payment_purity')) {
                    $table->decimal('gold_payment_purity', 8, 2)->default(100)->after('gold_payment_grams');
                }
                if (!Schema::hasColumn('retail_purchases', 'gold_payment_fine_wt')) {
                    $table->decimal('gold_payment_fine_wt', 15, 3)->default(0)->after('gold_payment_purity');
                }
                if (!Schema::hasColumn('retail_purchases', 'gold_payment_rate')) {
                    $table->decimal('gold_payment_rate', 15, 2)->default(0)->after('gold_payment_fine_wt');
                }
                if (!Schema::hasColumn('retail_purchases', 'gold_payment_amount')) {
                    $table->decimal('gold_payment_amount', 15, 2)->default(0)->after('gold_payment_rate');
                }
                if (!Schema::hasColumn('retail_purchases', 'remaining_metal_wt')) {
                    $table->decimal('remaining_metal_wt', 15, 3)->default(0)->after('gold_payment_amount');
                }
                if (!Schema::hasColumn('retail_purchases', 'remaining_metal_amount')) {
                    $table->decimal('remaining_metal_amount', 15, 2)->default(0)->after('remaining_metal_wt');
                }
            });
        }

        if (Schema::hasTable('retail_purchase_payments')) {
            Schema::table('retail_purchase_payments', function (Blueprint $table) {
                if (!Schema::hasColumn('retail_purchase_payments', 'metal_weight')) {
                    $table->decimal('metal_weight', 15, 3)->default(0)->after('amount');
                }
                if (!Schema::hasColumn('retail_purchase_payments', 'metal_purity')) {
                    $table->decimal('metal_purity', 8, 2)->default(100)->after('metal_weight');
                }
                if (!Schema::hasColumn('retail_purchase_payments', 'metal_fine_wt')) {
                    $table->decimal('metal_fine_wt', 15, 3)->default(0)->after('metal_purity');
                }
                if (!Schema::hasColumn('retail_purchase_payments', 'metal_rate')) {
                    $table->decimal('metal_rate', 15, 2)->default(0)->after('metal_fine_wt');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('retail_purchases')) {
            Schema::table('retail_purchases', function (Blueprint $table) {
                $table->dropColumn([
                    'gold_payment_grams',
                    'gold_payment_purity',
                    'gold_payment_fine_wt',
                    'gold_payment_rate',
                    'gold_payment_amount',
                    'remaining_metal_wt',
                    'remaining_metal_amount',
                ]);
            });
        }

        if (Schema::hasTable('retail_purchase_payments')) {
            Schema::table('retail_purchase_payments', function (Blueprint $table) {
                $table->dropColumn([
                    'metal_weight',
                    'metal_purity',
                    'metal_fine_wt',
                    'metal_rate',
                ]);
            });
        }
    }
};
