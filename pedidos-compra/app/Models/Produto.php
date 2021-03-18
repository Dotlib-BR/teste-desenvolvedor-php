<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Pedido;

class Produto extends Model
{

    use Sortable;

    protected $fillable = array('codigo_barras', 'nome_produto', 'valor_unitario');
    
    public $sortable = ['id', 'codigo_barras', 'nome_produto','valor_unitario'];

    public function pedido()
    {
        return $this->belongsToMany(Pedido::class);
    }

}
