<?php

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $cpf = '';
    
    for ($i = 0; $i<11; $i++) {
        $cpf .= mt_rand(0,9);
    }
    
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'cpf' => $cpf,
        'email_verified_at' => now(),
        'password' => Hash::make('secret'), // password
        'remember_token' => Str::random(10),
    ];
});
