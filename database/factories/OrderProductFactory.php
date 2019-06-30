<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(OrderProduct::class, function (Faker $faker) {
    return [
        'order_id'   => Order::all()->random()->id,
        'product_id' => Product::all()->random()->id,
        'amount'     => $faker->numberBetween(1, 20)
    ];
});
