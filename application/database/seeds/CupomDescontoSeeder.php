<?php

use App\Contracts\Repositories\CupomDescontoInterface;
use Illuminate\Database\Seeder;

class CupomDescontoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(CupomDescontoInterface $cupomDescontoInterface)
    {
        factory($cupomDescontoInterface->getModel(), 5)->create();
    }
}
