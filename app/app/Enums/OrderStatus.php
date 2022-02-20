<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const Ordered = 0;
    const Production = 1;
    const Shipped = 2;
    const Delivered = 3;
}