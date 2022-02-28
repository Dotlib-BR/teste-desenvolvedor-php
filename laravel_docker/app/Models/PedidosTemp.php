<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class PedidosTemp extends Model
{
    // Nome da tabela
    protected $table = 'pedidos_temporarios';

    // Nome do ID
    protected $primaryKey = 'carrinhoId';
    // ID será AI (auto generate)
    public $increment = false;

    // Colunas da tabela
    protected $fillable = [
        // Nenhum dado é passível de ser alterado por enquanto
        'carrinhoId',
        'cadastroId'
    ];

    // Colunas de created_at e updated_at
    public $timestamps = true;
}