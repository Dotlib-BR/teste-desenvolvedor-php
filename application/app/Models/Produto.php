<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'cod_barras',
        'valor',
        'qtd_estoque',
        'ativo',
    ];
}
