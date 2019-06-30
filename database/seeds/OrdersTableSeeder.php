<?php

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderProduct;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 100)->create()->each(function($order) {

            $order->products()->saveMany(factory(OrderProduct::class, rand(1, 20))->make());
        });
    }
}
