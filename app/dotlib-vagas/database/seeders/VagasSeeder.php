<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VagasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Vaga::factory(60)->create();
    }
}
