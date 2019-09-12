<?php

if (!function_exists('number_readable')) {
    function number_readable($value, $prefix = "", $suffix = "", $hideZeroDecimals = false)
    {
        $formatted = number_format($value, 2, ',', '.');
        $formatted = $hideZeroDecimals ? str_replace(",00", "", (string) $formatted) : $formatted;
        return $prefix.$formatted.$suffix;
    }
}
