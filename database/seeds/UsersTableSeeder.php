<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'DotLib',
            'email'    => 'dotlib@dotlib.com',
            'password' => bcrypt('dotlib'),
            'document' => ''
        ]);

        factory(User::class, 99)->create();
    }
}
