<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientUsers = [];
        $adminUsers = [];

        if (app()->environment('local')){
            $adminUsers = [
                [
                    'name' => 'Admin',
                    'type' => User::TYPE_ADMINISTRADOR,
                    'email' => 'admin@email.com',
                    'password' => Hash::make('12345678'),
                ]
            ];

            $clientUsers = [
                [
                    'name' => 'Cliente',
                    'type' => User::TYPE_CLIENT,
                    'email' => 'cliente@email.com',
                    'password' => Hash::make('12345678'),
                ]
            ];
        }
        User::factory()->createMany($clientUsers);
        User::factory(9)->create();
        User::factory()->createMany($adminUsers);
    }
}
