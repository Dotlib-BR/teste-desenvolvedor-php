<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->count(50)->create();

        $products = Product::all();

        Order::all()->each(function (Order $order) use ($products) {
            $order->products()->attach(
                $products->random(rand(1, 10))->pluck('id')->toArray(),
                [
                    'quantity' => rand(1, 10),
                    'price' => $products->random()->price,
                ]
            );
        });
    }
}
