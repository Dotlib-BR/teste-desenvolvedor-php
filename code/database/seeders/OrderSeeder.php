<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::find(1)->orders()->saveMany(Order::factory(2)->create());
        Client::find(3)->orders()->saveMany(Order::factory(5)->create());
        Client::find(5)->orders()->save(Order::factory()->create());
    }
}
