<?php

use Illuminate\Database\Seeder;
use App\Models\Vaga;

class VagaSeeder extends Seeder
{
    public function run()
    {
        Vaga::factory()->count(20)->create();
    }
}

