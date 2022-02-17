<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new Status();
        $status->create(['descricao' => 'Em aberto']);
        $status->create(['descricao' => 'Pago']);
        $status->create(['descricao' => 'Cancelado']);
    }
}
