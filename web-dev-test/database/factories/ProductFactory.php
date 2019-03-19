<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->lexify('????????'),
        'price' => $faker->numerify('###'),
        'bar_code' => $faker->numerify('#############'),
        'quantity' => $faker->numerify('####')
    ];
});
