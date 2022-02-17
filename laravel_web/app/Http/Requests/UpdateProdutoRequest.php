<?php

namespace App\Http\Requests;

use App\Rules\NomeCompleto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
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
        return [
            'cod_barras' => 'required|numeric',
            'nome' => ['required', new NomeCompleto, 'max:45'],
            'valor' => 'required',
            'quantidade' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cod_barras.required' => 'O campo CÓDIGO DE BARRAS é obrigatório', 
            'cod_barras.numeric' => 'Digite apenas números',
            'nome.required' => 'O campo NOME é obrigatório', 
            'nome.max' => 'Máximo de 45 caracteres atingido', 
            'valor.required' => 'O campo VALOR é obrigatório',
            'quantidade.required' => 'O campo QUANTIDADE é obrigatório', 
            'status.required' => 'O campo STATUS é obrigatório', 
        ];
    }
}
