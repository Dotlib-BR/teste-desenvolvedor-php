<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TipoContratacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_contratacao', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->decimal('salario',10,2)->nullable();
            $table->string('alocacao')->nullable();
            $table->unsignedBigInteger('tipo_contratacao_id');
            $table->timestamps();

            $table->foreign('tipo_contratacao_id')->references('id')->on('tipo_contratacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
