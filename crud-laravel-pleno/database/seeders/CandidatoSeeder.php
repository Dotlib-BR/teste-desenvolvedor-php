<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidato;

class CandidatoSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Candidato::factory()->count(20)->create()->each(function ($candidato) {
            $candidato->inscricoes()->createMany(
                \App\Models\Inscricao::factory()->count(3)->raw()
            );
        });
    }
}
