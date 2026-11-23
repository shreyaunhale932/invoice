<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cms_solutions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description', 1000);
            $table->string('url', 2048);
            $table->string('icon_class', 80);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('highlighted')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $solutions = [
            ['Invoice & Sell Management', 'Create invoices with GST, charges, and fast billing.', 'bi bi-cloud', false],
            ['Purchase Management', 'Track vendor purchases, receipts, and stock.', 'bi bi-grid', false],
            ['Karigar & Job Work', 'Manage artisan jobs, production, and weight reconciliation.', 'bi bi-credit-card', false],
            ['Barcode & RFID Tagging', 'Identify jewellery and track stock accurately.', 'bi bi-people', false],
            ['Discount & Scheme Management', 'Manage offers, loyalty rewards, and discounts.', 'bi bi-upc-scan', false],
            ['Real-Time MIS Reports', 'Monitor sales, inventory, and business performance.', 'bi bi-book', false],
            ['Multi-Branch Management', 'Manage multiple stores from one dashboard.', 'bi bi-tag', false],
            ['Old Gold Exchange', 'Evaluate, weigh, and process old gold exchanges.', 'bi bi-box', true],
            ['Inventory Management', 'Track jewellery stock by weight, purity, category, and location.', 'bi bi-box', true],
        ];

        $timestamp = now();
        foreach ($solutions as $index => [$title, $description, $iconClass, $highlighted]) {
            DB::table('cms_solutions')->insert([
                'title' => $title,
                'description' => $description,
                'url' => '/invoice-and-solution',
                'icon_class' => $iconClass,
                'sort_order' => $index + 1,
                'highlighted' => $highlighted,
                'is_active' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_solutions');
    }
};
