<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const Ordered = 0;
    const Production = 1;
    const Shipped = 2;
    const Delivered = 3;

    public static function getDescription($value): string
    {
        switch($value) {
            case self::Ordered:
                return "Pedido";
                break;

            case self::Production:
                return "Em produção";
                break;

            case self::Shipped:
                return "Enviado";
                break;

            case self::Delivered:
                return "Entregue";
                break;
        }
        
        return parent::getDescription($value);
    }
}