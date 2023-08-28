<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Rodar as migrations.
     */
    public function up(): void
    {
        Schema::create('inscricoes', function (Blueprint $table) {
            $table->id(); // Chave Primaria
            $table->unsignedBigInteger('vaga_id'); //cahave estrangeira ref. vagas
            $table->unsignedBigInteger('candidato_id'); //chave estrangeira ref. candidatos
            $table->timestamp('data_inscricao')->default(now()); // Data inscrição momento atual

            $table->foreign('vaga_id')->references('id')->on('vagas'); // Chave estrangeira tb vagas
            $table->foreign('candidato_id')->references('id')->on('candidatos'); // Chave estr. tb candidatos
        });
    }

    /**
     * Reverter the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes');
    }
};
