<?php

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
//        factory(\App\Models\Status::class, 50)->create();
        $statuses = array('Em Aberto', 'Pago', 'Cancelado');

        foreach ($statuses as $status) {
            $newStatus = new \App\Models\Status();
            $newStatus->title = $status;
            $newStatus->save();
        }
    }
}
