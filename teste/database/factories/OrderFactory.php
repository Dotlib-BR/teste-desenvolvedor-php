<?php

$factory->define(App\Models\Order::class, function (Faker\Generator $faker) {
    return [
        'product_id' => rand(1, 50),
        'purchase_id' => rand(1, 50),
        'quantity' => rand(1, 1000)
    ];
});
