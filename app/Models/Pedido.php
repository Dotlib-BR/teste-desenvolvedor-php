<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = ['identificador','user_id','nota_vendedor','status_pedido','status_compra','valor_total_pedido','desconto_total_pedido','quantitade_total_pedido'];
    public function items(){
        return $this->hasMany(\App\Models\PedidoProduto::class);
     }
}
