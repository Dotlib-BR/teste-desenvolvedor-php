<?php

use App\Models\Client as AppClient;
use App\Models\Order;
use App\Models\Status;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {    
    return [
        'status_id' => Status::all()->random()->id,
        'client_id' => AppClient::all()->random()->id,
        'number' => $faker->randomNumber(5, true),
        'date_order' => $faker->dateTime(),
        'discount' => $faker->randomFloat(2, 20, 100),
    ];
});
