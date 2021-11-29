<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VagaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'POST': {
                return [
                    'titulo' => 'required',
                    'descricao' => 'required',
                    'nivel' => 'required|in:junior,pleno,senior',
                    'categoria' => 'required|in:CLT,PJ,Freelancer',
                    'regime' => 'required|in:presencial,remoto',
                    'salario' => 'required|numeric',
                    'is_paused' => 'boolean',

                    'tags' => 'required',
                ];
            }


            case 'PATCH' : {
                return [
                    'titulo' => 'required',
                    'descricao' => 'required',
                    'nivel' => 'required|in:junior,pleno,senior',
                    'categoria' => 'required|in:CLT,PJ,Freelancer',
                    'regime' => 'required|in:presencial,remoto',
                    'salario' => 'required|numeric',
                    'is_paused' => 'boolean',

                    'tags' => 'required',
                ];
            }
        }
    }

    public function messages(){

        return [
            'titulo.required' => 'Título da vaga é obrigatório',
            'descricao.required' => 'Descrição da vaga é obrigatório',
            'nivel.required' => 'Nível da vaga é obrigatório',
            'nivel.in' => 'Opção selecionada para o nível da vaga é inválida',
            'categoria.required' => 'Categoria da vaga é obrigatório',
            'categoria.in' => 'Opção selecionada para a categoria da vaga é inválida',
            'regime.required' => 'Regime da vaga é obrigatório',
            'regime.in' => 'Opção selecionada para o regime da vaga é inválida',
            'salario.required' => 'Salário da vaga é obrigatório',
            'salario.numeric' => 'O campo salário deve ser númerico',
            'tags.required' => 'É necessário selecionar ao menos 1 tag de tecnologia',
        ];
    }
}
