<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosProdutos extends Model
{
    use HasFactory;

    protected $fillable = [
        'idProduto',
        'quantidadeProduto',
        'idPedido'
    ];
}
