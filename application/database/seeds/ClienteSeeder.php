<?php

use App\Contracts\Repositories\ClienteInterface;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ClienteInterface $clienteInterface)
    {
        factory($clienteInterface->getModel(), 10)->create();
    }
}
