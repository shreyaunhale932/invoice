<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSubscription;
use App\Services\CashfreeSubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Throwable;

class SubscriptionController extends Controller
{

    public function create(Request $request, CashfreeSubscriptionService $cashfree)
    {
        $request->validate([
           'plan_type' => 'required|in:basic,pro,premium',
            'billing_cycle' => 'required|in:monthly,yearly',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first.',
            ], 401);
        }

        // Prevent another subscription while one is active
        $activeSubscription = AdminSubscription::where('admin_id', $admin->id)
            ->where('status', 'active')
            ->exists();

        if ($activeSubscription) {
            return response()->json([
                'success' => false,
                'message' => 'You already have an active subscription.',
            ], 422);
        }

        $planType = $request->plan_type;
        $billingCycle = $request->billing_cycle;

        // GST-inclusive plan amounts
       $plans = [
    'basic' => [
        'monthly' => ['name' => 'Basic Monthly', 'amount' => 2950],
        'yearly'  => ['name' => 'Basic Yearly', 'amount' => 35400],
    ],
    'pro' => [
        'monthly' => ['name' => 'Pro Monthly', 'amount' => 4956],
        'yearly'  => ['name' => 'Pro Yearly', 'amount' => 58646],
    ],
    'premium' => [
        'monthly' => ['name' => 'Premium Monthly', 'amount' => 7351.40],
        'yearly'  => ['name' => 'Premium Yearly', 'amount' => 81774],
    ],
];

        $plan = $plans[$planType][$billingCycle] ?? null;

        $planId = config("cashfree.plans.{$planType}.{$billingCycle}");

        if (!$plan || !$planId) {
            return response()->json([
                'success' => false,
                'message' => 'Selected subscription plan is not configured yet.',
            ], 422);
        }

        // Unique merchant subscription reference
        $subscriptionId = 'JELERP_' . $admin->id . '_' . strtoupper(Str::random(10));

        // Save pending subscription
        $subscription = AdminSubscription::create([
            'admin_id' => $admin->id,
            'plan_name' => $plan['name'],
            'billing_cycle' => $billingCycle,
            'amount' => $plan['amount'],
            'currency' => 'INR',
            'cashfree_plan_id' => $planId,
            'cashfree_subscription_id' => $subscriptionId,
            'status' => 'pending',
        ]);

        try {
            $returnUrl = route('admin.subscription.return');

            $response = $cashfree->createSubscription(
                $admin,
                $planId,
                $subscriptionId,
                $returnUrl
            );

            $subscription->update([
                'cf_subscription_id' => $response['cf_subscription_id'] ?? null,
                'subscription_session_id' => $response['subscription_session_id'] ?? null,
                'cashfree_status' => $response['subscription_status'] ?? null,
                'authorization_status' =>
                $response['authorization_details']['authorization_status'] ?? null,
                'next_schedule_date' => $response['next_schedule_date'] ?? null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Subscription created successfully.',
                'subscription_id' => $subscription->id,
                'subscription_session_id' =>
                $response['subscription_session_id'] ?? null,
                'cashfree_status' => $response['subscription_status'] ?? null,
            ]);
        } catch (Throwable $e) {
            $subscription->update([
                'status' => 'failed',
            ]);

            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Unable to create subscription. Please try again.',
            ], 500);
        }
    }


    public function verify($id, CashfreeSubscriptionService $cashfree)
    {
        $admin = Auth::guard('admin')->user();

        // Find this admin's subscription in the central database
        $subscription = AdminSubscription::where('id', $id)
            ->where('admin_id', $admin->id)
            ->firstOrFail();

        try {
            // Use our merchant-generated subscription reference
            $response = $cashfree->getSubscription(
                $subscription->cashfree_subscription_id
            );

            $cashfreeStatus = $response['subscription_status'] ?? null;

            $authorizationStatus =
                $response['authorization_details']['authorization_status'] ?? null;

            $subscription->update([
                'cashfree_status' => $cashfreeStatus,
                'authorization_status' => $authorizationStatus,
                'next_schedule_date' => $response['next_schedule_date'] ?? null,
            ]);

            // Activate only after Cashfree confirms ACTIVE
            if ($cashfreeStatus === 'ACTIVE') {
                $subscription->update([
                    'status' => 'active',
                    'started_at' => $subscription->started_at ?? now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'cashfree_status' => $cashfreeStatus,
                'authorization_status' => $authorizationStatus,
                'local_status' => $subscription->fresh()->status,
                'message' => 'Subscription status verified.',
            ]);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Unable to verify subscription with Cashfree.',
            ], 500);
        }
    }

    public function index()
    {
        $admin = Auth::guard('admin')->user();

        $activeSubscription = AdminSubscription::where('admin_id', $admin->id)
            ->where('status', 'active')
            ->latest('id')
            ->first();

        return view('subscription.index', compact('activeSubscription'));
    }
}
