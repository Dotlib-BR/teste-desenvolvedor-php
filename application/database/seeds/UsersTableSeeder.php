<?php

use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(UserRepository $userRepository)
    {
        $userRepository->updateOrCreate([
            'email' => 'admin@admin.com',
        ],
        [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt(12345678),
        ]);
    }
}
