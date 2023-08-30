<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inscricao;

class InscricaoSeeder extends Seeder
{
    public function run()
    {
        Inscricao::factory()->count(20)->create(); // Mudar 'inscricoes' para 'inscricaos'
    }
}
