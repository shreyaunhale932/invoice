
<?php

return [

    'supplier' => [
        'name' => env('SUBSCRIPTION_SUPPLIER_NAME'),
        'gstin' => env('SUBSCRIPTION_SUPPLIER_GSTIN'),
        'address' => env('SUBSCRIPTION_SUPPLIER_ADDRESS'),
        'state' => env('SUBSCRIPTION_SUPPLIER_STATE', 'Maharashtra'),
        'state_code' => env('SUBSCRIPTION_SUPPLIER_STATE_CODE', '27'),
    ],

    'gst_rate' => 18,

    'invoice_prefix' => 'SS',

];
