<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'nameProduct' => $faker->name,
        'barCod' => Str::random(20),
        'unitValue' => $faker->numberBetween($min = 1000, $max = 9000),
        'amount' => $faker->randomDigit
    ];
});
