<?php

namespace App\Services;

use App\Models\AdminSubscription;
use App\Models\SubscriptionPayment;
use App\Models\SubscriptionInvoice;
use App\Services\SubscriptionGstService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RuntimeException;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class SubscriptionInvoiceService
{
    public function generate(SubscriptionPayment $payment): SubscriptionInvoice
    {
        return DB::connection('landlord')->transaction(function () use ($payment) {

            // Prevent duplicate invoices for the same payment
            $existingInvoice = SubscriptionInvoice::where(
                'subscription_payment_id',
                $payment->id
            )->first();

            if ($existingInvoice) {
                return $existingInvoice;
            }

            if ($payment->status !== 'success' || $payment->payment_type !== 'CHARGE') {
                throw new RuntimeException(
                    'Invoice can only be generated for successful recurring payments.'
                );
            }

            $payment->load('subscription.admin');

            $subscription = $payment->subscription;
            $admin = $subscription?->admin;

            if (!$admin) {
                throw new RuntimeException('Admin details not found.');
            }

            $stateCode = trim((string) $admin->state_code);

            if (!$stateCode) {
                throw new RuntimeException('Customer state code is missing.');
            }

            $gst = app(SubscriptionGstService::class)->calculate(
                (float) $payment->amount,
                $stateCode
            );

            $invoiceNumber = $this->generateInvoiceNumber();

            return SubscriptionInvoice::create([
                'admin_subscription_id' => $subscription->id,
                'subscription_payment_id' => $payment->id,
                'invoice_number' => $invoiceNumber,

                'customer_name' => $admin->company ?: $admin->name,
                'customer_email' => $admin->email,
                'customer_gstin' => $admin->gstin,
                'billing_address' => implode(', ', array_filter([
                    $admin->address,
                    $admin->city,
                    $admin->state,
                    $admin->pincode,
                ])),
                'place_of_supply' => $admin->state,

                'taxable_amount' => $gst['taxable_amount'],
                'cgst_amount' => $gst['cgst_amount'],
                'sgst_amount' => $gst['sgst_amount'],
                'igst_amount' => $gst['igst_amount'],
                'gst_rate' => $gst['gst_rate'],
                'total_amount' => $gst['total_amount'],

                'currency' => $payment->currency,
                'status' => 'generated',
                'issued_at' => now(),
            ]);
        });
    }

    private function generateInvoiceNumber(): string
    {
        $financialYear = now()->month >= 4
            ? now()->format('Y') . '-' . substr((string) (now()->year + 1), -2)
            : (now()->year - 1) . '-' . now()->format('y');

        $prefix = config('subscription.invoice_prefix', 'SS')
            . '/' . $financialYear . '/';

        $lastInvoice = SubscriptionInvoice::where(
            'invoice_number',
            'like',
            $prefix . '%'
        )
            ->orderByDesc('id')
            ->lockForUpdate()
            ->first();

        $lastNumber = $lastInvoice
            ? (int) substr($lastInvoice->invoice_number, strrpos($lastInvoice->invoice_number, '/') + 1)
            : 0;

        return $prefix . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    }


public function generatePdf(SubscriptionInvoice $invoice): SubscriptionInvoice
{
    $pdf = Pdf::loadView('subscription.invoice-pdf', [
        'invoice' => $invoice,
    ])->setPaper('a4');

    $path = 'subscription-invoices/' .
        str_replace('/', '_', $invoice->invoice_number) . '.pdf';

    Storage::disk('local')->put($path, $pdf->output());

    $invoice->update([
        'pdf_path' => $path,
    ]);

    return $invoice;
}
}
