<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Product::class)->create([
            'nameProduct' => 'GTX 1080ti',
            'barCod' => '42691571135257981414',
            'unitValue' => '2100',
            'amount' => '12'
        ]);

        factory(App\Product::class)->create([
            'nameProduct' => 'GTX 980ti',
            'barCod' => '42691572215257981797',
            'unitValue' => '2100',
            'amount' => '12'
        ]);

        factory(App\Product::class)->create([
            'nameProduct' => 'GTX 3060ti',
            'barCod' => '42691571135253231797',
            'unitValue' => '2100',
            'amount' => '12'
        ]);

        factory(App\Product::class)->create([
            'nameProduct' => 'GTX 2080ti',
            'barCod' => '42691571135257981797',
            'unitValue' => '2100',
            'amount' => '12'
        ]);

        factory(App\Product::class)->create([
            'nameProduct' => 'GTX 1060ti',
            'barCod' => '88178942473198132654',
            'unitValue' => '2100',
            'amount' => '12'
        ]);
    }
}
