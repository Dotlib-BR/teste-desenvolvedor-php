<?php

use App\Repositories\PedidoRepository;
use Illuminate\Database\Seeder;

class PedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PedidoRepository $pedidoRepository)
    {
        factory($pedidoRepository->getModel(), 10)->create();
    }
}
