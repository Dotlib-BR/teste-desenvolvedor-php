<?php

namespace Database\Seeders;

use App\Models\Tecnologia;
use App\Models\TecnologiaVaga;
use App\Models\Vaga;
use Illuminate\Database\Seeder;

class TecnologiaVagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tecnologias = Tecnologia::inRandomOrder()->take(rand(3,5))->get();
        $vagas = Vaga::all();

        foreach($vagas as $vaga){
            foreach($tecnologias as $tecnologia){
                TecnologiaVaga::firstOrCreate([
                    'tecnologia_id' => $tecnologia->id,
                    'vaga_id' => $vaga->id
                ]);
            }
        }
    }
}
