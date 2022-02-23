<?php

namespace App\Services;

class HelperService
{
    /**
     * @param int|float|double $value
     * @return string
     */
    public static function numberToMoney($value): string
    {
        $outputValue = number_format($value, 2, ',', '');
        return "R$ $outputValue";
    }
}