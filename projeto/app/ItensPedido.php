<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItensPedido extends Model
{
    protected $fillable = ['pedido_id', 'produto_id', 'quantidade', 'subtotal'];
    protected $table = "itensPedido";

    public function pedidos()
    {
        return $this->belongsTo('App\Pedidos');
    }

    public function produtos()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }
}
