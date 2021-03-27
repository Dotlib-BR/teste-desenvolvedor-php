<?php

use App\Contracts\Repositories\UserInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(UserInterface $userInterface)
    {
        $userInterface->updateOrCreate([
            'email' => 'admin@admin.com',
        ],
        [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt(12345678),
            'api_token'   => Str::random(60),
        ]);
    }
}
