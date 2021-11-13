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
            $table->string('descricao');
            $table->string('requisito_obrigatorio')->nullable();
            $table->string('requisito_diferencial')->nullable();
            $table->string('beneficios')->nullable();
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
