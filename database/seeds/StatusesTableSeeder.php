<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Em Aberto', 
            'Pago', 
            'Cancelado'
        ];

        foreach ($statuses as $status) {
            Status::create([
                'name' => $status,
            ]);
        }
    }
}
