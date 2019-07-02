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
        $this->call(ProductsTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(PurchasesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
