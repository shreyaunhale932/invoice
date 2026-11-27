<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\AdminSubscription;
use App\Models\SubscriptionPayment;
use App\Services\SubscriptionInvoiceService;
use App\Mail\SubscriptionInvoiceMail;


class CashfreeWebhookController extends Controller
{
    public function handle(
        Request $request,
        SubscriptionInvoiceService $invoiceService
    ) {
        // 1. Verify Cashfree signature
        $rawBody = $request->getContent();
        $signature = $request->header('x-webhook-signature');
        $timestamp = $request->header('x-webhook-timestamp');

        if (!$signature || !$timestamp) {
            return response()->json([
                'success' => false,
                'message' => 'Missing webhook signature headers.',
            ], 400);
        }

        $expectedSignature = base64_encode(
            hash_hmac(
                'sha256',
                $timestamp . $rawBody,
                config('cashfree.client_secret'),
                true
            )
        );

        if (!hash_equals($expectedSignature, $signature)) {
            Log::warning('Invalid Cashfree webhook signature.');

            return response()->json([
                'success' => false,
                'message' => 'Invalid webhook signature.',
            ], 401);
        }

        // 2. Parse verified payload
        $payload = json_decode($rawBody, true);

        if (!is_array($payload)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid webhook payload.',
            ], 400);
        }

        $eventType = $payload['type'] ?? 'unknown';
        $data = $payload['data'] ?? [];

        Log::info('Cashfree subscription webhook received', [
            'event_type' => $eventType,
        ]);

        // Generic Cashfree test event
        if ($eventType === 'WEBHOOK') {
            Log::info('Cashfree test webhook received.');

            return response()->json(['success' => true]);
        }

        // 3. Extract subscription ID from documented top-level data
        // 3. Extract subscription ID from supported payload structures
        $subscriptionId = $data['subscription_id']
            ?? $data['subscription_details']['subscription_id']
            ?? null;

        if (!$subscriptionId) {
            Log::warning('Cashfree webhook missing subscription ID', [
                'event_type' => $eventType,
            ]);

            return response()->json(['success' => true]);
        }

        $subscription = AdminSubscription::where(
            'cashfree_subscription_id',
            $subscriptionId
        )->first();

        if (!$subscription) {
            Log::warning('Cashfree subscription not found locally', [
                'subscription_id' => $subscriptionId,
                'event_type' => $eventType,
            ]);

            return response()->json(['success' => true]);
        }

        // 4. Authorization status event
        if ($eventType === 'SUBSCRIPTION_AUTH_STATUS') {
            $authStatus = $data['authorization_details']['authorization_status']
                ?? null;

            if ($authStatus) {
                $subscription->authorization_status = $authStatus;
                $subscription->save();
            }

            return response()->json(['success' => true]);
        }

        // 5. Subscription status event
        // if ($eventType === 'SUBSCRIPTION_STATUS_CHANGED') {
        //     $status = $data['subscription_details']['subscription_status']
        //         ?? null;

        //     if ($status) {
        //         $subscription->cashfree_status = $status;

        //         $statusMap = [
        //             'ACTIVE' => 'active',
        //             'ON_HOLD' => 'on_hold',
        //             'COMPLETED' => 'completed',
        //             'CUSTOMER_CANCELLED' => 'cancelled',
        //             'CUSTOMER_PAUSED' => 'paused',
        //             'CANCELLED' => 'cancelled',
        //             'EXPIRED' => 'expired',
        //             'LINK_EXPIRED' => 'expired',
        //             'CARD_EXPIRED' => 'expired',
        //             'BANK_APPROVAL_PENDING' => 'pending',
        //         ];

        //         if (isset($statusMap[$status])) {
        //             $subscription->status = $statusMap[$status];
        //         }

        //         if ($status === 'ACTIVE') {
        //             $subscription->started_at ??= now();
        //         }

        //         $subscription->next_schedule_date =
        //             $data['subscription_details']['next_schedule_date']
        //             ?? $subscription->next_schedule_date;

        //         $subscription->save();
        //     }

        //     return response()->json(['success' => true]);
        // }

        if ($eventType === 'SUBSCRIPTION_STATUS_CHANGED') {

            $details = $data['subscription_details'] ?? [];

            $status = $details['subscription_status'] ?? null;
            $previousStatus = $subscription->status;

            if ($status) {
                $statusMap = [
                    'ACTIVE' => 'active',
                    'ON_HOLD' => 'on_hold',
                    'COMPLETED' => 'completed',
                    'CUSTOMER_CANCELLED' => 'cancelled',
                    'CUSTOMER_PAUSED' => 'paused',
                    'CANCELLED' => 'cancelled',
                    'EXPIRED' => 'expired',
                    'LINK_EXPIRED' => 'expired',
                    'CARD_EXPIRED' => 'expired',
                    'BANK_APPROVAL_PENDING' => 'pending',
                ];

                $subscription->cashfree_status = $status;

                if (isset($statusMap[$status])) {
                    $subscription->status = $statusMap[$status];
                }

                if ($status === 'ACTIVE') {
                    $subscription->started_at ??= now();
                }

                $subscription->next_schedule_date =
                    $details['next_schedule_date']
                    ?? $subscription->next_schedule_date;

                $subscription->authorization_status =
                    $data['authorization_details']['authorization_status']
                    ?? $subscription->authorization_status;

                $subscription->save();

                // Send confirmation only on first activation
                if ($status === 'ACTIVE' && $previousStatus !== 'active') {

                    $admin = \App\Models\Admin::find($subscription->admin_id);

                    if ($admin && $admin->email) {
                        Mail::raw(
                            "Hello {$admin->name},\n\n"
                                . "Your {$subscription->plan_name} subscription has been activated successfully.\n\n"
                                . "Subscription amount: ₹" . number_format((float) $subscription->amount, 2) . "\n"
                                . "Billing cycle: {$subscription->billing_cycle}\n\n"
                                . "Thank you for choosing JewelERP.",
                            function ($message) use ($admin) {
                                $message->to($admin->email)
                                    ->subject('JewelERP Subscription Activated');
                            }
                        );
                    }
                }
            }

            return response()->json(['success' => true]);
        }

        // 6. Process only payment success and failure events
        if (!in_array($eventType, [
            'SUBSCRIPTION_PAYMENT_SUCCESS',
            'SUBSCRIPTION_PAYMENT_FAILED',
        ])) {
            return response()->json(['success' => true]);
        }

        $paymentType = $data['payment_type'] ?? null;

        // AUTH is mandate authorization, not subscription revenue
        if ($paymentType === 'AUTH') {
            $authStatus = $data['authorization_details']['authorization_status']
                ?? null;

            if ($authStatus) {
                $subscription->authorization_status = $authStatus;
                $subscription->save();
            }

            Log::info('Cashfree AUTH payment ignored for invoicing', [
                'subscription_id' => $subscriptionId,
            ]);

            return response()->json(['success' => true]);
        }

        if ($paymentType !== 'CHARGE') {
            Log::warning('Unknown Cashfree payment type', [
                'subscription_id' => $subscriptionId,
                'payment_type' => $paymentType,
            ]);

            return response()->json(['success' => true]);
        }

        $cashfreePaymentId = $data['cf_payment_id'] ?? null;

        if (!$cashfreePaymentId) {
            Log::warning('Cashfree payment missing cf_payment_id', [
                'event_type' => $eventType,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment ID missing.',
            ], 400);
        }

        $paymentStatus = $eventType === 'SUBSCRIPTION_PAYMENT_SUCCESS'
            ? 'success'
            : 'failed';

        // Do not trust event name alone; verify payment status too
        $reportedStatus = strtoupper($data['payment_status'] ?? '');

        if (
            ($paymentStatus === 'success' && $reportedStatus !== 'SUCCESS') ||
            ($paymentStatus === 'failed' && $reportedStatus !== 'FAILED')
        ) {
            Log::warning('Cashfree payment event/status mismatch', [
                'event_type' => $eventType,
                'payment_status' => $reportedStatus,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment status mismatch.',
            ], 400);
        }

        // 7. Save or update payment record
        $payment = DB::connection('landlord')->transaction(
            function () use (
                $subscription,
                $data,
                $cashfreePaymentId,
                $paymentStatus
            ) {
                return SubscriptionPayment::updateOrCreate(
                    [
                        'cashfree_payment_id' => (string) $cashfreePaymentId,
                    ],
                    [
                        'admin_subscription_id' => $subscription->id,
                        'payment_type' => 'CHARGE',
                        'amount' => $data['payment_amount'] ?? 0,
                        'currency' => $data['payment_currency'] ?? 'INR',
                        'status' => $paymentStatus,
                        'payment_method' => $data['payment_group'] ?? null,
                        'paid_at' => $paymentStatus === 'success'
                            ? ($data['payment_initiated_date'] ?? now())
                            : null,
                        'webhook_payload' => $data,
                    ]
                );
            }
        );

        Log::info('Cashfree subscription payment saved', [
            'subscription_id' => $subscriptionId,
            'payment_id' => $cashfreePaymentId,
            'status' => $paymentStatus,
        ]);

        // 8. Generate invoice and send email only for successful CHARGE
        if ($paymentStatus === 'success') {
            try {


                $invoice = $invoiceService->generate($payment);

                // Generate and store the PDF only if it does not already exist.
                if (!$invoice->pdf_path) {
                    $invoice = $invoiceService->generatePdf($invoice);
                }

                // Send the stored PDF by email only once.
                if (!$invoice->email_sent_at) {
                    Mail::to($invoice->customer_email)
                        ->send(new SubscriptionInvoiceMail($invoice));

                    $invoice->update([
                        'email_sent_at' => now(),
                    ]);
                }

                Log::info('Subscription GST invoice processed', [
                    'invoice_number' => $invoice->invoice_number,
                    'payment_id' => $cashfreePaymentId,
                ]);
            } catch (\Throwable $e) {
                Log::error('Subscription invoice/email processing failed', [
                    'payment_id' => $cashfreePaymentId,
                    'error' => $e->getMessage(),
                ]);

                // Non-2xx response allows Cashfree to retry
                return response()->json([
                    'success' => false,
                    'message' => 'Invoice/email processing failed.',
                ], 500);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Webhook processed successfully.',
        ]);
    }
}
