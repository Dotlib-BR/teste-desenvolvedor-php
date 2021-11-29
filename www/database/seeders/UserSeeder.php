<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserFactory::times(25)->empresa()->create();
        UserFactory::times(25)->candidato()->create();
    }
}
