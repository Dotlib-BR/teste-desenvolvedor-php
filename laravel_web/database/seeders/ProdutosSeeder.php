<?php

namespace Database\Seeders;

use App\Models\Produtos;
use Illuminate\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produtos::factory(20)->create();
    }
}
