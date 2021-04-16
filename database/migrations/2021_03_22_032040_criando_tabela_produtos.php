<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_produto');
            $table->string('slug')->unique();
            $table->text('descricao')->nullable();
            $table->decimal('valor_unitario');
            $table->decimal('preco_promocional')->nullable();
            $table->string('sku');
            $table->string('cod_barras');
            $table->enum('status_estoque',['disponivel','indisponivel']);
            $table->boolean('destaque')->default(false);
            $table->unsignedInteger('quantidade_estoque')->default(20);
            $table->string('imagem')->nullable();
            $table->bigInteger('categoria_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}


