<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cms_pricing_comparison_settings', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->default('COMPARE PLANS');
            $table->string('title')->default('Find your perfect fit');
            $table->text('description')->nullable();
            $table->string('feature_heading')->default('Feature');
            $table->json('features')->nullable();
            $table->timestamps();
        });

        DB::table('cms_pricing_comparison_settings')->insert([
            'eyebrow' => 'COMPARE PLANS',
            'title' => 'Find your perfect fit',
            'description' => 'All plans cover the essentials. Choose based on your team and reporting needs.',
            'feature_heading' => 'Feature',
            'features' => json_encode([
                ['label' => 'Invoices per month', 'values' => ['basic' => 'Unlimited', 'pro' => 'Unlimited', 'premium' => 'Unlimited', 'enterprise' => 'Unlimited']],
                ['label' => 'Team members', 'values' => ['basic' => '1', 'pro' => '3', 'premium' => 'Up to 10', 'enterprise' => 'Unlimited']],
                ['label' => 'Inventory alerts', 'values' => ['basic' => '—', 'pro' => 'Included', 'premium' => 'Included', 'enterprise' => 'Included']],
                ['label' => 'Advanced reports', 'values' => ['basic' => '—', 'pro' => 'Included', 'premium' => 'Included', 'enterprise' => 'Included']],
                ['label' => 'Multi-branch overview', 'values' => ['basic' => '—', 'pro' => '—', 'premium' => 'Included', 'enterprise' => 'Included']],
                ['label' => 'Support', 'values' => ['basic' => 'Standard', 'pro' => 'Priority', 'premium' => 'Dedicated', 'enterprise' => '24/7 Dedicated SLA']],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_pricing_comparison_settings');
    }
};
