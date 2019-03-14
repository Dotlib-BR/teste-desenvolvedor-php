<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
    protected $table = 'pedidos';
    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'ClienteId', 'Id');
    }

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'ProdutoId', 'Id');
    }
}
