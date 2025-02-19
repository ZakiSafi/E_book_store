<?php

if (!function_exists('ordinal')) {
    function ordinal($number)
    {
        if (!is_numeric($number)) return $number;

        $suffixes = ['th', 'st', 'nd', 'rd'];
        $mod100 = $number % 100;

        return $number . ($suffixes[($mod100 - 20) % 10] ?? ($suffixes[$mod100] ?? $suffixes[0]));
    }
}
