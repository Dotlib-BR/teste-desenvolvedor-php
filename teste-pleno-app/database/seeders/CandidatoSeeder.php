<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidato;

class CandidatoSeeder extends Seeder
{
    public function run()
    {
        Candidato::factory()->count(30)->create();
    }
}
