<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FilterModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CupomDesconto extends Model
{
    use FilterModel, SoftDeletes;

    protected $fillable = [
        'nome',
        'codigo',
        'tipo',
        'valor'
    ];

    // public function getValorAttribute($valor)
    // {
    //     return formatoCupomValor($valor);
    // }
}
