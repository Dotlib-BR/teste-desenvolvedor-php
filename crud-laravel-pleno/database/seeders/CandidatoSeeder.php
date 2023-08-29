<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidato;
use App\Models\Inscricao;

class CandidatoSeeder extends Seeder
{
    public function run()
    {
        Candidato::factory()->count(20)->create()->each(function ($candidato) {
            $candidato->inscricoes()->createMany(
                Inscricao::factory()->count(3)->raw()
            );
        });
    }
}
