<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            VagaSeeder::class,
            CandidatoSeeder::class,
            InscricaoSeeder::class,
            UserSeeder::class,
        ]);
    }
}