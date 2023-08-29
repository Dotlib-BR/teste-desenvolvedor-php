<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Roda a migration.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('nivel_acesso');
            $table->timestamps();
        });

        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->string('tipo');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->text('experiencia_profissional');
            $table->text('habilidades');
            $table->string('disponibilidade');
            $table->timestamps();
        });

        Schema::create('inscricaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vaga_id');
            $table->unsignedBigInteger('candidato_id');
            $table->timestamp('data_inscricao');
            $table->timestamps();

            $table->foreign('vaga_id')->references('id')->on('vagas')->onDelete('cascade');
            $table->foreign('candidato_id')->references('id')->on('candidatos')->onDelete('cascade');
        });
    }

    /**
     * Reverte a migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricaos');
        Schema::dropIfExists('candidatos');
        Schema::dropIfExists('vagas');
        Schema::dropIfExists('users');
    }
};