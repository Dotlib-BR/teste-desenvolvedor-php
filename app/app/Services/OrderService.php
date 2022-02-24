<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use Throwable;
use App\Models\Product;
use Illuminate\Support\Collection;

class OrderService
{
    /**
     * @param int $client_id
     * @param array $products
     */
    public static function create(int $client_id, array $products)
    {
        $order = Order::create([
            'client_id' => $client_id,
        ]);

        try {
            OrderProductService::createFromOrder($order, $products);
        } catch (Throwable $error) {
            $order->delete();
            throw $error;
        }
    }
}
