<?php

if (!function_exists('number_readable')) {
    function number_readable($value, $prefix = "", $suffix = "")
    {
        $formatted = str_replace(",00", "", (string) number_format($value, 2, ',', '.'));
        return $prefix.$formatted.$suffix;
    }
}
