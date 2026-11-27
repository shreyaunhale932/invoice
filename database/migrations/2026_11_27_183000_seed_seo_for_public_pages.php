<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $timestamp = now();
        $pages = [
            [
                'page_key' => 'faqs',
                'page_name' => 'FAQs',
                'title' => 'Jewellery ERP Software FAQs | Jewelerp',
                'description' => 'Find answers to common questions about Jewelerp jewellery ERP software, billing, inventory, pricing, setup, and support.',
                'keywords' => 'jewellery ERP FAQs, jewellery software questions, jewellery billing software help, jewellery inventory software support, Jewelerp FAQs',
                'canonical_url' => 'https://jewelerp.in/FAQS',
            ],
            [
                'page_key' => 'integration',
                'page_name' => 'Integration',
                'title' => 'Jewellery Software Integrations | Jewelerp',
                'description' => 'Connect your jewellery business workflows with Jewelerp integrations for billing, inventory, accounting, and day-to-day operations.',
                'keywords' => 'jewellery software integration, jewellery ERP integration, jewellery billing integration, jewellery inventory integration, Jewelerp integrations',
                'canonical_url' => 'https://jewelerp.in/integration',
            ],
            [
                'page_key' => 'invoice-solution',
                'page_name' => 'Invoice & Solution',
                'title' => 'Jewellery Billing and ERP Solutions | Jewelerp',
                'description' => 'Manage jewellery invoicing and business operations with Jewelerp tools for billing, inventory, reporting, and customer workflows.',
                'keywords' => 'jewellery invoicing software, jewellery ERP solution, jewellery billing software, jewellery business management, Jewelerp',
                'canonical_url' => 'https://jewelerp.in/invoice-and-solution',
            ],
            [
                'page_key' => 'purchase-management',
                'page_name' => 'Purchase Management',
                'title' => 'Jewellery Purchase Management Software | Jewelerp',
                'description' => 'Track jewellery purchases, supplier transactions, stock, and purchase records with Jewelerp purchase management software.',
                'keywords' => 'jewellery purchase management, jewellery purchase software, jewellery supplier management, jewellery inventory software, Jewelerp',
                'canonical_url' => 'https://jewelerp.in/purchase-management',
            ],
            [
                'page_key' => 'karigar-job-work',
                'page_name' => 'Karigar & Job Work',
                'title' => 'Jewellery Karigar and Job Work Management | Jewelerp',
                'description' => 'Manage jewellery karigar assignments, job work, metal issue and receipt, and work tracking with Jewelerp.',
                'keywords' => 'jewellery karigar management, jewellery job work software, karigar accounting, jewellery manufacturing software, Jewelerp',
                'canonical_url' => 'https://jewelerp.in/karigar-and-job-work',
            ],
            [
                'page_key' => 'barcode-rfid',
                'page_name' => 'Barcode & RFID',
                'title' => 'Jewellery Barcode and RFID Tagging Software | Jewelerp',
                'description' => 'Label and track jewellery inventory using barcode and RFID tagging workflows built for jewellery businesses.',
                'keywords' => 'jewellery barcode software, jewellery RFID software, jewellery tagging software, jewellery inventory tracking, Jewelerp',
                'canonical_url' => 'https://jewelerp.in/barcode-and-rfid-tagging',
            ],
            [
                'page_key' => 'discount-scheme',
                'page_name' => 'Discount & Scheme Management',
                'title' => 'Jewellery Discount and Scheme Management | Jewelerp',
                'description' => 'Set up and manage jewellery discounts, customer schemes, and promotional offers with Jewelerp business software.',
                'keywords' => 'jewellery discount management, jewellery scheme software, jewellery offer management, jewellery billing software, Jewelerp',
                'canonical_url' => 'https://jewelerp.in/discount-and-scheme-management',
            ],
            [
                'page_key' => 'real-time-mis',
                'page_name' => 'Real-Time MIS Reports',
                'title' => 'Jewellery Business MIS and Reports | Jewelerp',
                'description' => 'View jewellery business performance with real-time MIS reports for sales, inventory, purchasing, and operations.',
                'keywords' => 'jewellery MIS reports, jewellery business reporting, jewellery inventory reports, jewellery ERP analytics, Jewelerp',
                'canonical_url' => 'https://jewelerp.in/real-time-mis-report',
            ],
            [
                'page_key' => 'multi-branch',
                'page_name' => 'Multi-Branch Management',
                'title' => 'Jewellery Multi-Branch Management Software | Jewelerp',
                'description' => 'Coordinate jewellery inventory, billing, and business operations across multiple branches with Jewelerp.',
                'keywords' => 'jewellery multi branch software, jewellery chain management, multi location inventory, jewellery ERP software, Jewelerp',
                'canonical_url' => 'https://jewelerp.in/multi-branch-management',
            ],
            [
                'page_key' => 'old-gold-exchange',
                'page_name' => 'Old Gold Exchange',
                'title' => 'Jewellery Old Gold Exchange Management | Jewelerp',
                'description' => 'Record and manage old gold exchange transactions, valuation, and customer billing with Jewelerp jewellery software.',
                'keywords' => 'old gold exchange software, jewellery exchange management, gold valuation software, jewellery billing software, Jewelerp',
                'canonical_url' => 'https://jewelerp.in/old-gold-exchange',
            ],
            [
                'page_key' => 'inventory-management',
                'page_name' => 'Inventory Management',
                'title' => 'Jewellery Inventory Management Software | Jewelerp',
                'description' => 'Track jewellery stock, product details, movements, and inventory levels with Jewelerp inventory management software.',
                'keywords' => 'jewellery inventory software, jewellery stock management, jewellery inventory tracking, jewellery ERP inventory, Jewelerp',
                'canonical_url' => 'https://jewelerp.in/inventory-management',
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
        DB::table('cms_seo_pages')->whereIn('page_key', [
            'faqs',
            'integration',
            'invoice-solution',
            'purchase-management',
            'karigar-job-work',
            'barcode-rfid',
            'discount-scheme',
            'real-time-mis',
            'multi-branch',
            'old-gold-exchange',
            'inventory-management',
        ])->delete();
    }
};
