<?php

namespace Database\Seeders;

use App\Models\Pedidos;
use Illuminate\Database\Seeder;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pedidos::factory(20)->create();
    }
}
