<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Pedidos extends Model
{
    // Nome da tabela
    protected $table = 'pedidos';

    // Nome do ID
    protected $primaryKey = 'pedidoId';
    // ID será AI (auto generate)
    public $increment = true;

    // Colunas da tabela
    protected $fillable = [
        // Nenhum dado é passível de ser alterado por enquanto
        'pedidoId',
        'pedidoCadastroId',
        'pedidoCarrinhoId',
        'pedidoStatus',
        'pedidoAglutinador',
        'pedidoCodBarras',
        'created_at',
        'updated_at'
    ];

    // Colunas de created_at e updated_at
    public $timestamps = true;
}