<?php

namespace App\Models;

use App\Util\AppUtil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    protected $table = 'vagas';

    protected $fillable = [
        'id',
        'titulo',
        'descricao',
        'requisito_obrigatorio',
        'requisito_diferencial',
        'beneficios',
        'tipo_contratacao_id',
        'salario',
        'alocacao',
        'pausada'
    ];


    public function getSalario() {
        return intval($this->salario) == 0 ? 'Não Informado' : number_format($this->salario,2,",",".");
    }
}
