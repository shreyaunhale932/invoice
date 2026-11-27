<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsInvoiceSolutionPage extends Model
{
    protected $fillable = ['content'];

    protected $casts = [
        'content' => 'array',
    ];

    public static function defaultContent(): array
    {
        return [
            'hero' => [
                'eyebrow' => 'FASTER JEWELLERY BILLING',
                'title' => 'Turn every counter sale into an accurate, effortless experience.',
                'description' => 'Bring metal rates, making charges, stones, taxes, discounts and customer details into one guided billing flow built for jewellery retail.',
                'benefits' => [
                    'Jewellery-specific workflows',
                    'Live connected data',
                ],
                'floating_label' => 'Invoice & Sell Management',
                'image' => 'front_assets/img/solutions/real-mis.jpg',
                'image_alt' => 'Jewellery billing and invoice management dashboard',
            ],
            'challenges' => [
                'eyebrow' => 'BUSINESS CHALLENGES',
                'title' => 'Replace uncertainty with control in invoice & sell management.',
                'description' => 'JewelERP brings the critical information and actions for this workflow into one connected system.',
                'items' => [
                    [
                        'title' => 'Complex price calculations',
                        'description' => 'Manual metal, stone and making-charge calculations slow down the counter.',
                    ],
                    [
                        'title' => 'Billing errors',
                        'description' => 'Tax, rate and discount mistakes create rework and reduce customer trust.',
                    ],
                    [
                        'title' => 'Disconnected customer history',
                        'description' => 'Past purchases and preferences are hard to find when they matter most.',
                    ],
                ],
            ],
            'features' => [
                'eyebrow' => 'KEY FEATURES',
                'title' => 'Everything your team needs for invoice & sell management.',
                'items' => [
                    [
                        'title' => 'Jewellery-ready POS',
                        'description' => 'Bill by weight, piece, purity, stone value and making method.',
                    ],
                    [
                        'title' => 'Live rate application',
                        'description' => 'Apply the right metal rate consistently across every counter.',
                    ],
                    [
                        'title' => 'Flexible payments',
                        'description' => 'Support split tenders, advances, schemes and exchange adjustments.',
                    ],
                    [
                        'title' => 'Customer purchase history',
                        'description' => 'See preferences and prior transactions while serving customers.',
                    ],
                ],
            ],
            'workflow' => [
                'eyebrow' => 'HOW IT WORKS',
                'title' => 'A clear workflow from start to finish.',
                'description' => 'Keep your team aligned with a structured process that updates connected records along the way.',
                'items' => [
                    [
                        'title' => 'Scan or select',
                        'description' => 'Add tagged jewellery to the bill in seconds.',
                    ],
                    [
                        'title' => 'Calculate',
                        'description' => 'JewelERP applies rates, charges, discounts and taxes.',
                    ],
                    [
                        'title' => 'Collect payment',
                        'description' => 'Record the payment mix, advance or exchange value.',
                    ],
                    [
                        'title' => 'Complete the sale',
                        'description' => 'Print or share the invoice and update stock instantly.',
                    ],
                ],
            ],
            'benefits' => [
                'eyebrow' => 'BUSINESS BENEFITS',
                'title' => 'Less manual effort. More confident decisions.',
                'description' => 'Improve the accuracy and pace of everyday work while keeping management in control.',
                'items' => [
                    'Shorter checkout times',
                    'Accurate GST-ready invoices',
                    'Consistent pricing across counters',
                    'Instant stock and ledger updates',
                ],
                'card_title' => 'Built around jewellery operations',
                'card_description' => 'JewelERP connects transaction detail with the weight, purity, value, item and customer context your business depends on.',
            ],
            'dashboard' => [
                'eyebrow' => 'Your Small Heading',
                'title' => 'The right information, ready when your team needs it.',
                'description' => 'A focused sales invoice workspace keeps transactions, exceptions and results easy to understand.',
                'image' => 'front_assets/img/solutions/real-mis.jpg',
                'image_alt' => 'JewelERP business management dashboard',
            ],
        ];
    }
}
