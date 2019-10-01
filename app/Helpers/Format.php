<?php

if (!function_exists('number_readable')) {
    function number_readable($value, $prefix = "", $suffix = "", $hideZeroDecimals = false)
    {
        $formatted = number_format($value, 2, ',', '.');
        $formatted = $hideZeroDecimals ? str_replace(",00", "", (string) $formatted) : $formatted;
        return $prefix.$formatted.$suffix;
    }
}

if (!function_exists('round_to')) {
    function round_to($x, $number)
    {
        return (ceil($number) % $x === 0) ? ceil($number) : round(($number + $x / 2) / $x) * $x;
    }
}
