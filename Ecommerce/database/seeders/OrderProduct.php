<?php

namespace Database\Seeders;

use App\Models\OrderProduct as OrderProductModel;
use Illuminate\Database\Seeder;

class OrderProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderProductModel::factory()->count(50)->create();
    }
}
