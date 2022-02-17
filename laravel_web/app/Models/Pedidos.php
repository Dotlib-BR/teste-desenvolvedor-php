<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = "pedidos";

    protected $fillable = [
        'cliente_id', 
        'produto_id', 
        'nome_cliente', 
        'email_cliente', 
        'cpf_cliente', 
        'cod_barras_produto', 
        'nome_produto', 
        'valor_un_produto', 
        'quantidade',
        'valor_total',
        'data_pedido', 
        'status', 
    ];
}
