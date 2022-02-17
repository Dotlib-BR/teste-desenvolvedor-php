<?php

namespace App\Http\Requests;

use App\Rules\DataValida;
use App\Rules\NomeCompleto;
use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'nome' => ['required', new NomeCompleto, 'max:45'],
            'email' => 'required|email|max:45|unique:clientes',
            'cpf' => 'required|numeric|unique:clientes',
            'celular' => 'required|max:14',
            'data_nascimento' => ['required', new DataValida],
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo NOME é obrigatório', 
            'email.required' => 'O campo EMAIL é obrigatório',
            'email.email' => 'Email inválido',
            'email.max' => 'Máximo de 45 caracteres atingido', 
            'email.unique' => 'EMAIL já cadastrado',
            'cpf.required' => 'O campo CPF é obrigatório', 
            'cpf.numeric' => 'Digite apenas números',
            'cpf.unique' => 'CPF já cadastrado',
            'celular.required' => 'O campo CELULAR é obrigatório', 
            'celular.max' => 'Máximo de 14 caracteres atingido',
            'data_nascimento.required' => 'O campo DATA DE NASCIMENTO é obrigatório', 
            'status.required' => 'O campo STATUS é obrigatório', 
        ];
    }
}
