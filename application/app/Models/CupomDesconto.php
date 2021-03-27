<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FilterModel;

class CupomDesconto extends Model
{
    use FilterModel;

    protected $fillable = [
        'nome',
        'codigo',
        'tipo',
        'valor'
    ];

    public function getValorAttribute($valor)
    {
        return formatoCupomValor($valor);
    }
}
