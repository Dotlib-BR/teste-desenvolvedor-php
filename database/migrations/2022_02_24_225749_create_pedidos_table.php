<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Status',20);
            $table->integer('Quantidade');
            $table->date('DtPedido');
            $table->float('Total', 8, 2);
            $table->integer('fk_cliente_id')->unsigned();
            $table->integer('fk_produto_id')->unsigned();
            $table->foreign('fk_cliente_id')->references('id')->on('clientes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('fk_produto_id')->references('id')->on('produtos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->timestamps();
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
};
