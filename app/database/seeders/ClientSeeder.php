<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @param int $count
     * @return void
     */
    public function run()
    {
        Client::factory()
            ->count(30)
            ->create();
    }
}
