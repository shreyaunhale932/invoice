<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class CashfreeSubscriptionService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('cashfree.base_url');
    }

    protected function request()
    {
        return Http::acceptJson()
            ->asJson()
            ->withHeaders([
                'x-client-id' => config('cashfree.client_id'),
                'x-client-secret' => config('cashfree.client_secret'),
                'x-api-version' => config('cashfree.api_version'),
            ])
            ->baseUrl($this->baseUrl)
            ->timeout(30);
    }

    
        
                 public function createSubscription(
    $admin,
    string $planId,
    string $subscriptionId,
    string $returnUrl
) {
    $firstChargeTime = now()->addMinutes(30)->toIso8601String();

    $response = $this->request()->post('/subscriptions', [
        'subscription_id' => $subscriptionId,

        'customer_details' => [
            'customer_name' => $admin->name,
            'customer_email' => $admin->email,
            'customer_phone' => $admin->phone,
        ],

        'plan_details' => [
            'plan_id' => $planId,
        ],

        'subscription_meta' => [
            'return_url' => $returnUrl,
        ],

       'subscription_first_charge_time' => now('Asia/Kolkata')
    ->addDay()
    ->setTime(10, 0)
    ->toIso8601String(),
    ]);

    if ($response->failed()) {
        throw new RuntimeException(
            'Cashfree subscription creation failed: ' . $response->body()
        );
    }

    return $response->json();
}

}