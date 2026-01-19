<?php

namespace App\Helpers;

class NumberHelper
{
    public static function convertToWords($amount)
    {
        if (!is_numeric($amount)) {
            return '';
        }

        // Force integer (no decimals)
        $number = (int) round(abs($amount));

        if ($number === 0) {
            return 'Zero Rupees Only';
        }

        $words = [
            0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four',
            5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
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

        // First group: 3 digits
        $part = $number % 1000;
        $number = intdiv($number, 1000);

        if ($part > 0) {
            $result = self::twoDigitWords($part, $words) . ' ' . $units[$i];
        }

        $i++;

        // Remaining groups: 2 digits
        while ($number > 0 && $i < count($units)) {
            $part = $number % 100;
            $number = intdiv($number, 100);

            if ($part > 0) {
                $result = self::twoDigitWords($part, $words) . ' ' . $units[$i] . ' ' . $result;
            }

            $i++;
        }

        return trim($result) . ' Rupees Only';
    }

    private static function twoDigitWords($num, $words)
    {
        $text = '';

        if ($num >= 100) {
            $text .= $words[intdiv($num, 100)] . ' Hundred ';
            $num %= 100;
        }

        if ($num > 0) {
            if ($num < 21) {
                $text .= $words[$num];
            } else {
                $text .= $words[intdiv($num, 10) * 10] . ' ' . $words[$num % 10];
            }
        }

        return trim($text);
    }
}
