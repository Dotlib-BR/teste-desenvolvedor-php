<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product as ProductsModel;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductsModel::factory()
        ->count(50)
        ->create();
    }
}
