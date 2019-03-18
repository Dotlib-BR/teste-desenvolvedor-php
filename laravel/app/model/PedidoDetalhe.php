<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalhe extends Model
{
    function produto(){
        return $this->belongsTo('App\model\Produto','produto_id');
    }

    function pedido(){
        return $this->belongsTo('App\model\Pedido','pedido_id');
    }
}
