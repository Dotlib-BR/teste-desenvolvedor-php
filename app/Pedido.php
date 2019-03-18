<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [ 'Quantidade', 'Status' ];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'ClienteId', 'id');
    }

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'ProdutoId', 'id');
    }
}
