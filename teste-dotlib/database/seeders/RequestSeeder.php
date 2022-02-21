<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Request::factory(50)->create();
    }
}
