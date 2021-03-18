<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'nome_cliente' => 'Fulano de Tal',
            'cpf' => '00011100111',
            'email' => 'fulano@hotmail.com'
        ]);

        DB::table('clientes')->insert([
            'nome_cliente' => 'Beltrano de Tal',
            'cpf' => '00011100222',
            'email' => 'beltrano@hotmail.com'
        ]);
    }
}
