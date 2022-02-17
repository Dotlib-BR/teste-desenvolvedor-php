<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id(); //numero pedido
            $table->string('codBarras');
            $table->date('dataPedido');
            $table->smallInteger('status')->default(1); //1- Em aberto | 2- Pago | 3- Cancelado
            $table->unsignedBigInteger('idCliente');
            $table->float('valorTotal');
            $table->timestamps();

            $table->foreign('idCliente')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
