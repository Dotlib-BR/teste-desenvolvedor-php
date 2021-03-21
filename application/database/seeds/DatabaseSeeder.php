<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(ProdutoTableSeeder::class);
        $this->call(CupomDescontoSeeder::class);
        $this->call(StatusPedidoTableSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(PedidoTableSeeder::class);
        $this->call(PedidoProdutoTableSeeder::class);
    }
}
