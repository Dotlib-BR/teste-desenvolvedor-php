<?php

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(OrderProduct::class, function (Faker $faker) {
    $order = Order::all()->random();
    $product = Product::all()->unique()->random();
    
    return [
        'order_id' => $order->id,
        'product_id' => $product->id,
        'price' => $product->price,
        'quantity' => $faker->randomNumber(1),
    ];
});
