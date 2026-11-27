
<?php

return [
    'environment' => env('CASHFREE_ENV', 'sandbox'),

    'client_id' => env('CASHFREE_CLIENT_ID'),

    'client_secret' => env('CASHFREE_CLIENT_SECRET'),

    'api_version' => env('CASHFREE_API_VERSION', '2025-01-01'),

    'base_url' => env('CASHFREE_ENV', 'sandbox') === 'production'
        ? 'https://api.cashfree.com/pg'
        : 'https://sandbox.cashfree.com/pg',

    'plans' => [
        'basic' => [
            'monthly' => 'plan_1795595225009_dviupt',
            'yearly' => 'plan_1795595422026_hy5103',
        ],

        'pro' => [
            'monthly' => 'plan_1795769901725_k08o19',
            'yearly' => 'plan_1795770433869_abr7ht',
        ],

        'premium' => [
            'monthly' => 'plan_1795770080214_56iffu',
            'yearly' => 'plan_1795770179763_bdlyro',
        ],
    ],
];
