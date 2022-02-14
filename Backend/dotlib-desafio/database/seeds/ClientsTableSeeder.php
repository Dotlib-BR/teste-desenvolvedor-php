<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Client::class)->create([
            'name' => 'felipe',
            'cpf' => '98065039002',
            'email' => 'email@store.com',
            'password' => 'password'
        ]);

        factory(App\Client::class)->create([
            'name' => 'paulo',
            'cpf' => '05056566582',
            'email' => 'email@store.com',
            'password' => 'password'
        ]);

        factory(App\Client::class)->create([
            'name' => 'rodrigo',
            'cpf' => '02265899885',
            'email' => 'email@store.com',
            'password' => 'password'
        ]);

        factory(App\Client::class)->create([
            'name' => 'jorge',
            'cpf' => '12062595863',
            'email' => 'email@store.com',
            'password' => 'password'
        ]);
    }
}
