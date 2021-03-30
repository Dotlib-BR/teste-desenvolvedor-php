<?php

namespace Database\Seeders;

use App\Models\Order as OrderModel;
use Illuminate\Database\Seeder;

class Order extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderModel::factory()->count(50)->create();
    }
}
