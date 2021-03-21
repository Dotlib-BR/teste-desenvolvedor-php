<?php

use App\Contracts\Repositories\ProdutoInterface;
use Illuminate\Database\Seeder;

class ProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ProdutoInterface $produtoInterface)
    {
        $test = factory($produtoInterface->getModel(), 10)->create();
    }
}
