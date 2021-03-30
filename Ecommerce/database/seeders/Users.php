<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User as UsersModel;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsersModel::factory()
        ->count(10)
        ->create();
    }
}
