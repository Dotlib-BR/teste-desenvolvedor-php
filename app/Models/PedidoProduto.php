<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;
use App\Models\Produto;

class PedidoProduto extends Model
{
    use HasFactory;
    protected $fillable = ['pedido_id','produto_id','quantidade_total','valor_comprado'];
    public function pedido(){
      return $this->belongsTo(\App\Models\Pedido::class);
      }
      public function produto(){
        return $this->belongsTo(\App\Models\Produto::class);
      }
}
