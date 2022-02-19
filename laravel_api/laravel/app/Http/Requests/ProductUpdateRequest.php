<?php

namespace App\Http\Requests;

use App\Rules\FullName;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'cod_bars' => 'required|min:9|numeric',
            'name' => ['required', new FullName, 'max:45'],
            'value' => 'required',
            'amount' => 'required',
            'stats' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cod_bars.required' => 'O campo CÓDIGO DE BARRAS é obrigatório', 
            'cod_bars.numeric' => 'Digite apenas números',
            'name.required' => 'O campo NOME é obrigatório', 
            'name.max' => 'Máximo de 45 caracteres atingido', 
            'value.required' => 'O campo VALOR é obrigatório',
            'amount.required' => 'O campo QUANTIDADE é obrigatório', 
            'stats.required' => 'O campo STATUS é obrigatório', 
        ];
    }
}
