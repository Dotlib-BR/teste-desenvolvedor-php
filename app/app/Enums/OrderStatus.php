<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const Ordered = 0;
    const Paid = 1;
    const Cancelled = 2;

    public static function getDescription($value): string
    {
        switch($value) {
            case self::Ordered:
                return "Em aberto";
                break;

            case self::Paid:
                return "Pago";
                break;

            case self::Cancelled:
                return "Cancelado";
                break;
        }
        
        return parent::getDescription($value);
    }
}