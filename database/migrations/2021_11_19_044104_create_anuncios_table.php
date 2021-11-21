<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('empresa_id')->unsigned();
            $table->string('titulo');
            $table->text('descricao');
            $table->float('remuneracao', 8,2);
            $table->boolean('ativo')->default(1);
            $table->enum('tipo_vaga', ['CLT', 'Pessoa Jurídica', 'Freelancer']);
            $table->timestamps();
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anuncios');
    }
}
