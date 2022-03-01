<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Cliente;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('clientes')->insert([
            'NomeCliente' => Str::random(30),
            'CPF' => Str::random(11),
            'Email' => Str::random(4).'@g.com',
        ]);*/
        Cliente::factory()
        ->count(30)
        ->create();


    }
}
