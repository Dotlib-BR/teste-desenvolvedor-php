<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('candidatos', function (Blueprint $table) {
            $table->unsignedBigInteger('vaga_id')->nullable(); // Adicione esta linha para a relação com vagas

            $table->foreign('vaga_id')->references('id')->on('vagas')->onDelete('cascade'); // Adicione esta linha para a relação com vagas
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidatos', function (Blueprint $table) {
            //
        });
    }
};
