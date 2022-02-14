<?php

use App\Order;
use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'id_client' => factory(App\Client::class),
        'id_product' => factory(App\Product::class),
        'status' => 'a',
        'dtPedido' => Carbon::now()
    ];
});
