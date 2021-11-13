<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    protected $table = 'vagas';

    protected $fillable = [
        'id',
        'descricao',
        'requisito_obrigatorio',
        'requisito_diferencial',
        'beneficios',
        'tipo_contratacao_id',
        'tipo_alocacao',
        'pausada'
    ];


}
