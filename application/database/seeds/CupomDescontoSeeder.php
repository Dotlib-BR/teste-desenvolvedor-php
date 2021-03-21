<?php

use App\Repositories\CupomDescontoRepository;
use Illuminate\Database\Seeder;

class CupomDescontoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(CupomDescontoRepository $cupomDescontoRepository)
    {
        factory($cupomDescontoRepository->getModel(), 5)->create();
    }
}
