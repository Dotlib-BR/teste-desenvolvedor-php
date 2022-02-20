<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
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
        // TODO: make possible to create more orderproducts than orders
        Order::factory()
            ->count(150)
            ->hasOrderProducts(1)
            ->create();
    }
}
