<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ClienteId');
            $table->unsignedBigInteger('ProdutoId');
            $table->dateTime('DtPedido');
            $table->integer('Quantidade')->unsigned();
            $table->tinyInteger('Status');

            // $table->timestamps();

            $table->foreign('ClienteId')->references('id')->on('clientes');
            $table->foreign('ProdutoId')->references('id')->on('produtos');
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
