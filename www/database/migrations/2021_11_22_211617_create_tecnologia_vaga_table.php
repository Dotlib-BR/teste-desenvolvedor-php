<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTecnologiaVagaTable extends Migration
{

    public function up()
    {
        Schema::create('tecnologia_vaga', function (Blueprint $table) {
            $table->unsignedBigInteger('tecnologia_id');
            $table->unsignedBigInteger('vaga_id');

            $table->foreign('tecnologia_id')->references('id')->on('tecnologias')->onDelete('cascade');
            $table->foreign('vaga_id')->references('id')->on('vagas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tecnologia_vaga');
    }
}
