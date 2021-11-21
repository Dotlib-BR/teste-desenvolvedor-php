<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anuncio;
use App\Models\Empresa;
use Illuminate\Support\Str;

class AnuncioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresas = Empresa::all();
        $enum = array('CLT', 'Pessoa Jurídica', 'Freelancer');
        for ($i=0; $i < sizeof($empresas) ; $i++) {
            Anuncio::create([
                    'empresa_id' => $empresas[$i]->id,
                    'titulo' =>  Str::random(25),
                    'descricao' =>  Str::random(80),
                    'remuneracao' => mt_rand(1000, 15000),
                    'tipo_vaga' => $enum[rand(0, 2)],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
