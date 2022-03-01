<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Produto;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'Status',
        'Quantidade',
        'DtPedido',
        'fk_cliente_id',
        'fk_produto_id'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'fk_produto_id');
    }

}
