<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagasTable extends Migration
{
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->string('slug');
            $table->string('titulo');
            $table->longText('descricao');
            $table->string('nivel');
            $table->string('categoria');
            $table->string('regime');
            $table->decimal('salario', 10, 2);
            $table->boolean('is_paused')->default(0);
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vagas');
    }
}
