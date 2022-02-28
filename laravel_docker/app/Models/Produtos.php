<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Produtos extends Model
{
    // Nome da tabela
    protected $table = 'produtos';

    // Nome do ID
    protected $primaryKey = 'produtoId';
    // ID será AI (auto generate)
    public $increment = true;

    // Colunas da tabela
    protected $fillable = [
        // Nenhum dado é passível de ser alterado por enquanto
        'produtoId',
        'produtoNome',
        'produtoAutor',
        'produtoValorUnitario',
        'produtoQtdeEstoque',
        'produtoFormato',
        'produtoImagem'
    ];

    // Colunas de created_at e updated_at
    public $timestamps = true;
}