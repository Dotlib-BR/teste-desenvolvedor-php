<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(200)->create();
        $this->call([
            EmpresaSeeder::class,
            AnuncioSeeder::class,
        ]);
    }
}
