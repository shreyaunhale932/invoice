<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cms_solutions', function (Blueprint $table) {
            $table->string('home_description', 1000)->nullable()->after('description');
            $table->string('tagline')->nullable()->after('home_description');
        });

        $homeContent = [
            'Invoice & Sell Management' => ['Create jewellery-specific invoices with making charges, stone values, GST and fast POS billing.', '1,280+ invoices/day'],
            'Purchase Management' => ['Record vendor purchases, metal receipts and inward stock with full traceability.', 'Full vendor tracking'],
            'Karigar & Job Work' => ['Issue raw gold to karigars, track job work progress, and record receipts with weight reconciliation.', 'Gold issue & receipt'],
            'Barcode & RFID Tagging' => ['Tag every jewellery piece with barcode or RFID for instant identification and stock accuracy.', 'Instant item ID'],
            'Discount & Scheme Management' => ['Configure seasonal offers, loyalty discounts and jewellery scheme plans for customers.', 'Smart pricing rules'],
            'Real-Time MIS Reports' => ['Access live sales, inventory, profitability and business performance reports at any time.', 'Live data, always'],
            'Multi-Branch Management' => ['Run multiple store locations from one dashboard with centralized inventory and reporting.', 'All branches, one view'],
            'Old Gold Exchange' => ['Evaluate, weigh and process old gold or jewellery exchange with accurate valuations.', 'Exchange & valuation'],
            'Inventory Management' => ['Track jewellery stock by weight, purity, category and location across your entire business.', '100% stock accuracy'],
        ];

        foreach ($homeContent as $menuTitle => [$description, $tagline]) {
            DB::table('cms_solutions')
                ->where('title', $menuTitle)
                ->update([
                    'home_description' => $description,
                    'tagline' => $tagline,
                ]);
        }

        DB::table('cms_solutions')
            ->whereNull('home_description')
            ->update([
                'home_description' => DB::raw('description'),
                'tagline' => '',
            ]);
    }

    public function down(): void
    {
        Schema::table('cms_solutions', function (Blueprint $table) {
            $table->dropColumn(['home_description', 'tagline']);
        });
    }
};
