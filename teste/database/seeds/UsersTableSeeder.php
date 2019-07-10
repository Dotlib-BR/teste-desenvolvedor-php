<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $token = Hash::make(Str::random(100));

        User::create([
            'name' => 'Admin',
            'email' => 'admin@dotlib.com',
            'password' => bcrypt('password'),
            'api_token' => $token,
            'api_token_ajax' => $token,
            'remember_token' => Str::random(100),
            'email_verified_at' => now(),
        ]);

        factory(User::class, 50)->create();
    }
}
