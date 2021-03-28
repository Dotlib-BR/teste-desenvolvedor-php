<?php

use App\Contracts\Repositories\PedidoInterface;
use Illuminate\Database\Seeder;

class PedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PedidoInterface $pedidoInterface)
    {
        $test = factory($pedidoInterface->getModel(), 25)->create();
    }
}
