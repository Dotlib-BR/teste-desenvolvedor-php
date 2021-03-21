<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'cliente_id',
        'status_pedido_id',
        'cupom_desconto_id',
        'numero_pedido',
        'valor_pedido',
        'valor_desconto',
        'valor_total',
    ];
}
