<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cms_pricing_settings', function (Blueprint $table) {
            $table->id();
            $table->string('main_heading')->default('The right plan to grow your');
            $table->string('main_heading_highlight')->default('jewellery business');
            $table->text('subheading')->nullable();
            $table->string('yearly_discount_badge')->default('Save up to 41%');
            $table->json('bottom_benefits')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('plan_label')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('popular_badge_text')->nullable()->default('MOST POPULAR');
            $table->text('description')->nullable();

            // Monthly
            $table->decimal('monthly_price', 10, 2)->default(0);
            $table->decimal('monthly_discount', 5, 2)->default(0);
            $table->decimal('monthly_cut_price', 10, 2)->default(0);
            $table->decimal('monthly_savings', 10, 2)->default(0);
            $table->string('monthly_billing_text')->nullable()->default('Billed monthly');

            // Yearly
            $table->decimal('yearly_price', 10, 2)->default(0);
            $table->decimal('yearly_discount', 5, 2)->default(0);
            $table->decimal('yearly_cut_price', 10, 2)->default(0);
            $table->decimal('yearly_savings', 10, 2)->default(0);
            $table->string('yearly_billing_text')->nullable()->default('Billed annually');

            // Common
            $table->string('currency_symbol', 10)->default('₹');
            $table->string('button_text')->default('Start free trial');
            $table->string('button_link')->default('#jewelSignupModal');
            $table->string('trial_note')->default('30 days free · Cancel anytime');
            $table->json('features')->nullable();

            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed initial section settings
        DB::table('cms_pricing_settings')->insert([
            'main_heading' => 'The right plan to grow your',
            'main_heading_highlight' => 'jewellery business',
            'subheading' => "Everything you need to bill faster, manage inventory, and make smarter decisions.\nStart free—no credit card required.",
            'yearly_discount_badge' => 'Save up to 41%',
            'bottom_benefits' => json_encode([
                'No setup fee',
                'Free data migration',
                'Friendly onboarding support',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed the 3 default plans from the UI
        $plans = [
            [
                'name' => 'Basic',
                'plan_label' => 'For small jewellery shops',
                'is_featured' => false,
                'popular_badge_text' => null,
                'description' => 'Essential billing and inventory tools to run your jewellery store with confidence.',
                'monthly_price' => 2520,
                'monthly_discount' => 16,
                'monthly_cut_price' => 3000,
                'monthly_savings' => 480,
                'monthly_billing_text' => 'Billed monthly',
                'yearly_price' => 29500,
                'yearly_discount' => 41,
                'yearly_cut_price' => 50000,
                'yearly_savings' => 20500,
                'yearly_billing_text' => 'Billed annually',
                'currency_symbol' => '₹',
                'button_text' => 'Start free trial',
                'button_link' => '#jewelSignupModal',
                'trial_note' => '30 days free · Cancel anytime',
                'features' => json_encode([
                    'Inventory & tag management',
                    'GST billing',
                    'Barcode printing',
                ]),
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Pro',
                'plan_label' => 'FOR GROWING BUSINESSES',
                'is_featured' => true,
                'popular_badge_text' => 'MOST POPULAR',
                'description' => 'Faster billing, smart automation, and better controls as your business grows.',
                'monthly_price' => 4200,
                'monthly_discount' => 16,
                'monthly_cut_price' => 5000,
                'monthly_savings' => 800,
                'monthly_billing_text' => 'Billed monthly',
                'yearly_price' => 49700,
                'yearly_discount' => 29,
                'yearly_cut_price' => 70000,
                'yearly_savings' => 20300,
                'yearly_billing_text' => 'Billed annually',
                'currency_symbol' => '₹',
                'button_text' => 'Start 30-day free trial',
                'button_link' => '#jewelSignupModal',
                'trial_note' => '30 days free · Cancel anytime',
                'features' => json_encode([
                    'Karigar & old-gold workflows',
                    'CRM, schemes & loyalty',
                    'Advanced MIS reports',
                ]),
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Premium',
                'plan_label' => 'FOR ESTABLISHED TEAMS',
                'is_featured' => false,
                'popular_badge_text' => null,
                'description' => 'Complete operational control with powerful reporting and priority assistance.',
                'monthly_price' => 6230,
                'monthly_discount' => 11,
                'monthly_cut_price' => 7000,
                'monthly_savings' => 770,
                'monthly_billing_text' => 'Billed monthly',
                'yearly_price' => 69300,
                'yearly_discount' => 23,
                'yearly_cut_price' => 90000,
                'yearly_savings' => 20700,
                'yearly_billing_text' => 'Billed annually',
                'currency_symbol' => '₹',
                'button_text' => 'Choose Premium',
                'button_link' => '#jewelSignupModal',
                'trial_note' => '30 days free · Cancel anytime',
                'features' => json_encode([
                    'Centralized multi-branch control',
                    'Manufacturing & integrations',
                    'Dedicated account manager',
                ]),
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        $timestamp = now();
        foreach ($plans as $plan) {
            $plan['created_at'] = $timestamp;
            $plan['updated_at'] = $timestamp;
            DB::table('cms_pricing_plans')->insert($plan);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_pricing_plans');
        Schema::dropIfExists('cms_pricing_settings');
    }
};
