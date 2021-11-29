<?php

namespace Database\Seeders;

use App\Models\Tecnologia;
use App\Models\TecnologiaVaga;
use App\Models\Vaga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TecnologiaVagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $vagas = Vaga::all();

        foreach($vagas as $vaga){

            $tecnologias = Tecnologia::inRandomOrder()->take(4)->get();

            foreach($tecnologias as $tecnologia){
                TecnologiaVaga::firstOrCreate([
                    'tecnologia_id' => $tecnologia->id,
                    'vaga_id' => $vaga->id
                ]);
            }
        }
    }
}
