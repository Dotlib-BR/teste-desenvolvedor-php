<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    function cliente(){
        return $this->belongsTo("App\model\Cliente","cliente_id");
    }

    function pedidoDetalhe(){
        return $this->hasMany("App\model\PedidoDetalhe","pedido_id");
    }
}
