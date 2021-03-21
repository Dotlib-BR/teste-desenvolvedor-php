<?php

use App\Repositories\ClienteRepository;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ClienteRepository $clienteRepository)
    {
        factory($clienteRepository->getModel(), 10)->create();
    }
}
