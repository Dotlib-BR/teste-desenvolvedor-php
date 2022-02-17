<?php

namespace Database\Seeders;

use App\Models\Clientes;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clientes::factory(20)->create();
    }
}
