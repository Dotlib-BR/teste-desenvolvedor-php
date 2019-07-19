<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['id','nome', 'email', 'password', 'cpf', 'perfil'];
    

    public function pedidos()
    {
        return $this->hasMany('App\Pedido', 'cliente_id');
    }
}
