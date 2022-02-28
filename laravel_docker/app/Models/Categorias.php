<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Categorias extends Model
{
    // Nome da tabela
    protected $table = 'categorias';

    // Nome do ID
    protected $primaryKey = 'categoriaId';
    // ID será AI (auto generate)
    public $increment = true;

    // Colunas da tabela
    protected $fillable = [
        // Nenhum dado é passível de ser alterado por enquanto
        'categoriaId',
        'categoriaNome',
        'created_at',
        'updated_at'
    ];

    // Colunas de created_at e updated_at
    public $timestamps = true;
}