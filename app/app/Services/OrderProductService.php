<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Collection;
use App\Models\Product;
use Exception;
use Throwable;

class OrderProductService
{
    /**
     * @param int $order_id
     * @param array $products
     * @return void
     */
    public static function createFromOrder(Order $order, array $products)
    {
        self::validateProducts($products);
        $orderProducts = array_map(function($product) use ($order) {
            return [
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'unit_price' => Product::find($product['id'])->price, 
            ];
        }, $products);

        $order->orderProducts()
            ->createMany($orderProducts);
    }

    private static function validateProducts(array $products)
    {
        if (!is_array($products[0]) || isset($products[0][0])) {
            throw new Exception('Invalid products format.');
        };
    }
}