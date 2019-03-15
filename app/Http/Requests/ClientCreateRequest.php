<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientCreateRequest extends FormRequest
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
            'name' => 'required|max:100',
            'email' => 'required|unique:users,email',
            'cpf' => 'required|unique:users,cpf|digits:11',
            'password' => 'required|min:4|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Por favor, informe o nome.',
            'name.max' => 'Por favor, informe um nome com no máximo 100 caracteres.',
            'email.required' => 'Por favor, informe um e-mail.',
            'email.unique' => 'O e-mail informado já existe no sistema.',
            'cpf.required' => 'Por favor, informe um CPF.',
            'cpf.unique' => 'O CPF informado já existe no sistema.',
            'cpf.digits' => 'O CPF deve conter somente 11 números.',
            'password.required' => 'Por favor, informe uma senha.',
            'password.min' => 'Por favor, informe uma senha com no mínimo 4 caracteres.',
            'password.confirmed' => 'Por favor, digite a mesma senha nos campos de senha.',
        ];
    }
}
