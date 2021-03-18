<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            'codigo_barras' => '7894900701159',
            'nome_produto' => 'Refrigerante Coca-Cola Zero - LATA 310 ml',
            'valor_unitario' => 2.90
        ]);

        DB::table('produtos')->insert([
            'codigo_barras' => '7891991015523',
            'nome_produto' => 'Cerveja Budweiser - LATA 410 ml',
            'valor_unitario' => 3.60
        ]);

        DB::table('produtos')->insert([
            'codigo_barras' => '7897744500636',
            'nome_produto' => 'AROMATIZANTE COALA ALGAS MARINHAS 140 ML',
            'valor_unitario' => 10.90
        ]);

        DB::table('produtos')->insert([
            'codigo_barras' => '7897744500111',
            'nome_produto' => 'Erva-Mate Marialva 1 KG',
            'valor_unitario' => 15.00
        ]);


    }
}
