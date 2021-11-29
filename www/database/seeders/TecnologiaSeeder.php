<?php

namespace Database\Seeders;

use Database\Factories\TecnologiaFactory;
use Illuminate\Database\Seeder;

class TecnologiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TecnologiaFactory::times(21)->create();
    }
}
