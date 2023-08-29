<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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