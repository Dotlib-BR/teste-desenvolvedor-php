<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    function pedidos(){
        return $this->hasMany("App\model\Pedido","produto_id");
    }
}
