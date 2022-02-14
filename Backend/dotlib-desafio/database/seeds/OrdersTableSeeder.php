<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '2',
            'id_client' => '3',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);

        factory(App\Order::class)->create([
            'id_product' => '1',
            'id_client' => '2',
            'status' => 'a',
            'dtPedido' => '2022-02-13'
        ]);
    }
}
