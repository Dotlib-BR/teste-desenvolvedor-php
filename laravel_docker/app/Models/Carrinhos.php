<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Carrinhos extends Model
{
    // Nome da tabela
    protected $table = 'carrinhos';

    // Nome do ID
    protected $primaryKey = 'carrinhoId';
    // ID será AI (auto generate)
    public $increment = true;

    // Colunas da tabela
    protected $fillable = [
        // Nenhum dado é passível de ser alterado por enquanto
        'carrinhoId',
        'carrinhoProdutoId',
        'carrinhoQuantidade',
        'created_at',
        'updated_at'
    ];

    // Colunas de created_at e updated_at
    public $timestamps = true;
}