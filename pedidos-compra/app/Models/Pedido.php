<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Produto;

class Pedido extends Model
{

    use Sortable;

    protected $fillable = array('data_pedido','cliente_id','quantidade_itens','status');
 

    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente','id','cliente_id');
    }

    public function produto()
    {
        return $this->belongsToMany(Produto::class);
    }

    
}
