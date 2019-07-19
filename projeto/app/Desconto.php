<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desconto extends Model
{
    protected $fillable = ['nome', 'valor', 'validade'];

    public function pedidos()
    {
        return $this->hasMany('App\Pedido', 'id');
    }
}
