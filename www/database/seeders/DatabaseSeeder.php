<?php

namespace Database\Seeders;

use App\Models\Candidato;
use App\Models\Empresa;
use App\Models\Tecnologia;
use App\Models\TecnologiaVaga;
use App\Models\User;
use App\Models\Vaga;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //UserSeeder::class,
            EmpresaSeeder::class,
            VagaSeeder::class,
            TecnologiaSeeder::class,
            TecnologiaVagaSeeder::class,
            CandidatoSeeder::class,
        ]);
    }
}
