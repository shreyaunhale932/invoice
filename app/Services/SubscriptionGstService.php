<?php

namespace App\Services;

class SubscriptionGstService
{
    public function calculate(float $totalAmount, string $customerState): array
    {
        $gstRate = (float) config('subscription.gst_rate', 18);

        // Prices are GST-inclusive
        $taxableAmount = round(
            $totalAmount / (1 + ($gstRate / 100)),
            2
        );

        $gstAmount = round($totalAmount - $taxableAmount, 2);

        $supplierStateCode = config('subscription.supplier.state_code', '27');

        // Compare state codes to determine intra-state or inter-state supply
        $customerStateCode = trim($customerState);

        if ($customerStateCode === $supplierStateCode) {
            $cgst = round($gstAmount / 2, 2);
            $sgst = $gstAmount - $cgst;
            $igst = 0;
        } else {
            $cgst = 0;
            $sgst = 0;
            $igst = $gstAmount;
        }

        return [
            'taxable_amount' => $taxableAmount,
            'cgst_amount' => $cgst,
            'sgst_amount' => $sgst,
            'igst_amount' => $igst,
            'gst_rate' => $gstRate,
            'total_amount' => $totalAmount,
        ];
    }
}

