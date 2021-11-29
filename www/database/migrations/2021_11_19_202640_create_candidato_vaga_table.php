<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatoVagaTable extends Migration
{

    public function up()
    {
        Schema::create('candidato_vaga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidato_id');
            $table->unsignedBigInteger('vaga_id');
            $table->string('path_curriculo');
            $table->timestamp('aplicado_em');
            $table->char('status', 20);

            $table->foreign('candidato_id')->references('id')->on('candidatos')->onDelete('cascade');
            $table->foreign('vaga_id')->references('id')->on('vagas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidato_vaga');
    }
}
