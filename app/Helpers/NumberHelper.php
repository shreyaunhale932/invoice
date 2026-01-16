<?php

namespace App\Helpers;

class NumberHelper
{
    public static function convertToWords($amount)
    {
        if (!is_numeric($amount)) {
            return '';
        }

        $amount = round($amount, 2);

        $number = floor($amount);
        $decimal = round(($amount - $number) * 100);

        $words = [
            0 => '',
            1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five',
            6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen',
            14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen',
            17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen',
            20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty',
            50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy',
            80 => 'Eighty', 90 => 'Ninety'
        ];

        $units = ['', 'Thousand', 'Lakh', 'Crore'];

        $result = '';
        $i = 0;

        while ($number > 0) {
            $divider = ($i == 1) ? 10 : 100;
            $part = $number % $divider;
            $number = intdiv($number, $divider);

            if ($part > 0) {
                $text = '';

                if ($part < 21) {
                    $text = $words[$part];
                } else {
                    $text = $words[intdiv($part, 10) * 10] . ' ' . $words[$part % 10];
                }

                $result = $text . ' ' . $units[$i] . ' ' . $result;
            }

            $i++;
        }

        $rupees = trim($result) ?: 'Zero';

        if ($decimal > 0) {
            $paise = $decimal < 21
                ? $words[$decimal]
                : $words[intdiv($decimal, 10) * 10] . ' ' . $words[$decimal % 10];

            return "{$rupees} Rupees And {$paise} Paise";
        }

        return "{$rupees} Rupees Only";
    }
}
