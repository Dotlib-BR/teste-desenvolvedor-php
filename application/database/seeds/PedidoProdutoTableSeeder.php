<?php

use App\Repositories\PedidoProdutoRepository;
use Illuminate\Database\Seeder;

class PedidoProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PedidoProdutoRepository $pedidoProdutoRepository)
    {
        factory($pedidoProdutoRepository->getModel(), 10)->create();
    }
}
