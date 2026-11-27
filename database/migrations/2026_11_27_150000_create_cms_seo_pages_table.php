<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cms_seo_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->string('page_name');
            $table->string('title');
            $table->text('description')->nullable();
            $table->longText('keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->timestamps();
        });

        $timestamp = now();
        $pages = [
            [
                'page_key' => 'home',
                'page_name' => 'Home',
                'title' => 'Best Jewellery ERP Software in India | Billing, Inventory & Purchase Management',
                'description' => 'Manage your jewellery business with powerful ERP software for billing, inventory, accounting, manufacturing, POS and karigar management.',
                'keywords' => 'jewellery ERP software, Jewellery ERP Software in India, jewellery software, jewellery billing software, jewellery inventory software, jewellery management software, jewellery business software, jewellery ERP software India, jewellery software India, jewellery billing software India, jewellery ERP software in Mumbai, jewellery accounting software, jewellery shop software, jewellery manufacturing software, jewellery GST billing software, jewellery barcode software, online jewellery ERP software, jewellery POS software, jewellery inventory management, jewellery inventory ERP, diamond inventory software, jewellery inventory tracking software, jewellery karigar management software, signup for free trial, jewellery accounting software in Ahmedabad, jewellery ERP software in Surat, jewellery ERP software in Jaipur, jewellery software in Delhi, jewellery POS software in Delhi, jewellery ERP software in Gurgaon',
                'canonical_url' => 'https://jewelerp.in/',
            ],
            [
                'page_key' => 'pricing',
                'page_name' => 'Pricing',
                'title' => 'Jewellery ERP Software Pricing & Plans in India | Jewelerp',
                'description' => 'Explore Jewelerp jewellery ERP software pricing and plans for billing, inventory and jewellery business management. Start your 30-day free trial today!',
                'keywords' => 'jewellery ERP software pricing, jewellery software price, jewellery ERP pricing, jewellery ERP monthly plans, jewellery software pricing, jewellery billing software pricing, jewellery billing software in Pune, jewellery POS software in Pune, jewellery ERP software in Nagpur, jewellery software in Nashik, jewellery inventory software pricing, jewellery billing software in Bangalore, jewellery ERP software in Mysore, jewellery software in Chennai, jewellery management software pricing, jewellery business software, jewellery ERP software, online jewellery ERP software, jewellery accounting software, jewellery POS software, jewellery shop software, jewellery ERP software in Ahmedabad, jewellery software in Ahmedabad, Get Your Free Demo, Sign Up for Free Trial',
                'canonical_url' => 'https://jewelerp.in/pricing',
            ],
            [
                'page_key' => 'videos',
                'page_name' => 'Video',
                'title' => 'Jewellery Software Videos & Tutorials | Jewelerp',
                'description' => 'Watch Jewelerp jewellery ERP software videos and tutorials for billing, inventory, POS, mobile invoicing and RFID. Explore product features and book your free demo!',
                'keywords' => 'jewellery software, jewellery billing software, jewellery ERP software, jewellery management software, jewellery manufacturing software, jewellery software demo, jewellery billing software tutorial, jewellery ERP demo, jewellery ERP software tutorial, jewellery inventory software India, jewellery accounting software in Mumbai, online jewellery ERP software, jewellery billing software in Pune, jewellery inventory software in Nashik, jewellery management software in Ahmedabad, diamond inventory software in Surat, jewellery inventory software in Jaipur, Sign Up for Free Trial, Register & Get Started, Try Jewellery Software Free, Start Using Jewellery ERP',
                'canonical_url' => 'https://jewelerp.in/videos',
            ],
            [
                'page_key' => 'contact',
                'page_name' => 'Contact',
                'title' => 'Contact Jewelerp | Jewellery ERP Software & Demo',
                'description' => 'Looking for jewellery ERP software? Contact Jewelerp for jewellery billing and inventory management solutions. Book your free demo or start your 30-day free trial!',
                'keywords' => 'contact Jewelerp, jewellery ERP software, jewellery software, jewellery ERP demo, jewellery management software, jewellery billing software, jewellery inventory software, jewellery business software, jewellery accounting software, jewellery inventory software India, jewellery accounting software in Mumbai, online jewellery ERP software, jewellery billing software in Pune, jewellery inventory software in Nashik, jewellery management software in Ahmedabad, diamond inventory software in Surat, jewellery inventory software in Jaipur, Sign Up for Free Trial, Register & Get Started, Try Jewellery Software Free, Start Using Jewellery ERP',
                'canonical_url' => 'https://jewelerp.in/contact',
            ],
        ];

        foreach ($pages as $page) {
            $page['created_at'] = $timestamp;
            $page['updated_at'] = $timestamp;
            DB::table('cms_seo_pages')->insert($page);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_seo_pages');
    }
};
