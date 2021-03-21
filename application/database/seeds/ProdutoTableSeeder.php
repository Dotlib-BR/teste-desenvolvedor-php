<?php

use App\Repositories\ProdutoRepository;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ProdutoRepository $produtoRepository)
    {
        $test = factory($produtoRepository->getModel(), 10)->create();
    }
}
