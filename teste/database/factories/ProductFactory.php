<?php

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'barcode' => \Illuminate\Support\Str::random(50),
        'price' => $faker->randomFloat(2,10000, 100)
    ];
});
