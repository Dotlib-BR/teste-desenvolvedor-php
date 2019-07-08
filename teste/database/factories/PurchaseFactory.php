<?php

$factory->define(App\Models\Purchase::class, function (Faker\Generator $faker) {

    return [
        'client_id' => rand(1, 50),
        'discount_id' => rand(1, 50),
        'status_id' => rand(1, 3),
        'invoice_number' => \Illuminate\Support\Str::random(9),
        'total' => $faker->randomFloat(2,10000, 100)
    ];
});
