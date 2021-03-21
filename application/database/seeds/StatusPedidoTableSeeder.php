<?php

use App\Repositories\StatusPedidoRepository;
use Illuminate\Database\Seeder;

class StatusPedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(StatusPedidoRepository $statusPedidoRepository)
    {
        $statuses = ['Em Aberto', 'Pago', 'Cancelado'];

        foreach ($statuses as $status) {
            $statusPedidoRepository->updateOrCreate(['nome' => $status], ['nome' => $status]);
        }
    }
}
