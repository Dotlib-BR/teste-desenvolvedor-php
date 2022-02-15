<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'barcode' => $faker->numerify('####################'),
        'price' => $faker->randomFloat(2, 1, 15000),
    ];
});

