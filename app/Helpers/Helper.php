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

if (!function_exists('round_percent')) {

    /**
     * Convert a numeric value in the range of 0 to 5 to a percentage in the range of 0% to 100%.
     *
     * @param float $number The numeric value to be converted.
     * @return float The converted percentage value.
     */
    function round_percent(float $number): float
    {
        return round($number, 2);
    }
}

if(!function_exists('calculateTimeDifference')) {
    function calculateTimeDifference($dateTime)
    {
        // Convert given date string to DateTime object
        $givenDateTime = new DateTime($dateTime);

        // Get current date and time
        $currentDateTime = new DateTime();

        // Calculate the difference between current date/time and given date/time
        $interval = $currentDateTime->diff($givenDateTime);

        // Calculate total number of days
        $totalDays = $interval->days;

        // Calculate weeks
        $weeks = floor($totalDays / 7);
        $daysRemaining = $totalDays % 7;

        // Format the difference in terms of weeks, days, hours, etc.
        $output = '';
        if ($interval->y > 0) {
            $output .= $interval->y . ' year(s) ';
        }
        if ($interval->m > 0) {
            $output .= $interval->m . ' month(s) ';
        }
        if ($weeks > 0) {
            $output .= $weeks . ' week(s) ';
        }
        if ($daysRemaining > 0) {
            $output .= $daysRemaining . ' day(s) ';
        }
        if ($interval->h > 0) {
            $output .= $interval->h . ' hour(s) ';
        }
        if ($interval->i > 0) {
            $output .= $interval->i . ' minute(s) ';
        }
        if ($interval->s > 0) {
            $output .= $interval->s . ' second(s) ';
        }
        $output = explode(' ', $output);
        return $output[0].' '.$output[1];
    }
}
