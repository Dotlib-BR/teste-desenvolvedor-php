<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AuxVagasUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\AuxVagasUsers::factory(60)->create();
    }
}
