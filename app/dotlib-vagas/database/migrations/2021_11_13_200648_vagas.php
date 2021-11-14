<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vagas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descricao');
            $table->text('requisito_obrigatorio')->nullable();
            $table->text('requisito_diferencial')->nullable();
            $table->text('beneficios')->nullable();
            $table->decimal('salario',10,2)->nullable();
            $table->string('alocacao')->nullable();
            $table->boolean("pausada")->default(0);
            $table->unsignedBigInteger('tipo_contratacao_id');
            $table->timestamps();

            $table->foreign('tipo_contratacao_id')->references('id')->on('tipo_contratacao')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vagas');
    }
}
