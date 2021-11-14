<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoContratacao extends Model
{
    protected $table = 'tipo_contratacao';

    protected $fillable = [
        'id',
        'descricao'
    ];
}
