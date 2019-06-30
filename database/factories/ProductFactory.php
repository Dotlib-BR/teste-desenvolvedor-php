<?php

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function(Faker $faker) {
    return [
        'name'  => ucwords($faker->words(2, true)),
        'price' => $faker->numerify('##.##'),
        'code'  => $faker->unique()->numerify(str_repeat('#', 20))
    ];
});
