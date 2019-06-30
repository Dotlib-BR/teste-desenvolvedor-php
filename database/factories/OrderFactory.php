<?php

use App\Models\Order;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id'   => User::all()->random()->id,
        'status'    => $faker->randomElement(['open', 'paid', 'canceled']),
        'discount'  => $faker->numerify('##.##')
    ];
});
