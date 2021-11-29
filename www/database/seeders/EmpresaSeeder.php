<?php

namespace Database\Seeders;

use Database\Factories\EmpresaFactory;
use Database\Factories\UserFactory;
use Database\Factories\VagaFactory;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmpresaFactory::times(25)
        ->has(VagaFactory::times( rand(1, 5) ), 'vagas')->create();
    }
}
