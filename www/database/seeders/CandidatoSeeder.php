<?php

namespace Database\Seeders;

use Database\Factories\CandidatoFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class CandidatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CandidatoFactory::times(25)->create();
    }
}
