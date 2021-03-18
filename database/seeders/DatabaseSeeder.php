<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        Role::create([
            'position' => 'admin',
        ]);

        Role::create([
            'position' => 'user',
        ]);

        for ($i=0; $i < 50; $i++) {
            User::create([
                'name' => $faker->userName,
                'email' => $faker->email,
                'password' => Hash::make('password'),
                'role_id' => 2,
                'CPF' => $faker->randomNumber($nbDigits = NULL, $strict = false) . "\n",
                'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            ]);
        }

        for ($i=0; $i < 50; $i++) {
            Product::create([
                'product' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'bar_code' => $faker->isbn13,
                'price' => $faker->randomFloat(4, 1, 1000),
            ]);
        }
    }
}
