<?php

namespace Database\Seeders;

use App\Models\TipoContratacao;
use App\Models\Vaga;
use Illuminate\Database\Seeder;

class TipoContratacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoContratacao::create(['descricao' =>'CLT']);
        TipoContratacao::create(['descricao' =>'Pessoa Jurídica']);
        TipoContratacao::create(['descricao' =>'Freelancer']);
    }
}
