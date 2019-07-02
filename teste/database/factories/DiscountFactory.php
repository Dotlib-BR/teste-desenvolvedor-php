<?php

$factory->define(App\Models\Discount::class, function (Faker\Generator $faker) {

    return [
        'code' => strtoupper($faker->word),
        'percentage' => rand(1, 100)
    ];
});
