<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    function cliente(){
        return $this->belongsTo("App\model\Cliente","cliente_id");
    }

    function produto(){
        return $this->belongsTo("App\model\Produto","produto_id");
    }
}
