<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id','titulo','descricao','remuneracao','ativo','tipo_vaga'];

    public function rules()
    {
        return [
            'empresa_id' => 'required',
            'titulo' => 'required|min:5|max:50',
            'descricao' => 'required|min:10|max:1000',
            'remuneracao' => 'required|numeric|between:1000, 500000',
            'tipo_vaga' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'empresa_id.required' => 'O campo empresa é obrigatório',
            'remuneracao.required' => 'O campo salário é obrigatório',
            'tipo_vaga.required' => 'O campo tipo de contrato é obrigatório',
            'titulo.min' => 'O título deve ter no mínimo 3 caracteres',
            'titulo.max' => 'O título deve ter no maxímo 50 caracteres',
            'descricao.min' => 'A descrição deve ter no mínimo 10 caracteres',
            'descricao.max' => 'A descrição deve ter no maxímo 1000 caracteres',
            'remuneracao.numeric' => 'O campo :attribute deve ser do tipo numérico',
            'remuneracao.between'=>'São valídos apenas valores entre 1000 a 500000'
        ];
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }

    public function user() {
        return $this->belongsToMany("App\Models\User","vagas_vinculos", "user_id");
    }

}
