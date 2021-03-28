<?php

use App\Contracts\Repositories\PedidoProdutoInterface;
use Illuminate\Database\Seeder;

class PedidoProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PedidoProdutoInterface $pedidoProdutoInterface)
    {
        factory($pedidoProdutoInterface->getModel(), 25)->create();
    }
}
