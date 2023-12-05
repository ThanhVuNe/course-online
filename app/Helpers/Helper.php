<?php

if (!function_exists('convert_to_short_form')) {

    /**
     * @param int $number
     * @return string
     */
    function convert_to_short_form(int $number): string
    {
        if ($number < 1000) {
            return (string)$number;
        } elseif ($number < 1000000) {
            return number_format($number / 1000, 1) . 'k';
        }

        return number_format($number / 1000000, 1) . 'M';
    }
}

if (!function_exists('convert_to_percent')) {

    /**
     * Convert a numeric value in the range of 0 to 5 to a percentage in the range of 0% to 100%.
     *
     * @param float $number The numeric value to be converted.
     * @return float The converted percentage value.
     */
    function convert_to_percent(float $number): float
    {
        return ($number / 5) * 100;
    }
}
