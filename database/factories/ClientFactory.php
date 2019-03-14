<?php

use App\Models\Client;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
