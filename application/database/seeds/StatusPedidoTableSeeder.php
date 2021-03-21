<?php

use App\Contracts\Repositories\StatusPedidoInterface;
use Illuminate\Database\Seeder;

class StatusPedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(StatusPedidoInterface $statusPedidoInterface)
    {
        $statuses = ['Em Aberto', 'Pago', 'Cancelado'];

        foreach ($statuses as $status) {
            $statusPedidoInterface->updateOrCreate(['nome' => $status], ['nome' => $status]);
        }
    }
}
