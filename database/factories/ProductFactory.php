<?php

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->unique()->word()),
        'bar_code' => $faker->unique()->numerify(str_repeat('#', 20)),
        'price' => $faker->randomFloat(2, 20, 100),
    ];
});
