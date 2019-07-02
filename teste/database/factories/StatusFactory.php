<?php

$factory->define(App\Models\Status::class, function (Faker\Generator $faker) {

    return [
        'title' => strtoupper($faker->word)
    ];
});
