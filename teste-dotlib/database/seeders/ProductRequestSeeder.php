<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductRequest::factory(100)->create();
    }
}
