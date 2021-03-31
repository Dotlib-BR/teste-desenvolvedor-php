<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'unique:users,email|required',
            'document' => 'unique:users,document|required|cpf',
            'password' => 'min:6|max:16|required',
            'image' => 'image|mimes:jpeg,png,jpg|max:1920|nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo Obrigatorio.',
            'last_name.required' => 'Campo Obrigatorio.',
            'email.unique' => 'E-mail já existente, por favor insira outro.',
            'email.required' => 'Campo Obrigatorio.',
            'document.unique' => 'CPF já cadastrado.',
            'document.required' => 'Campo Obrigatorio.',
            'password.min' => 'A senha deve possuir 6 ou mais caracteres.',
            'password.max' => 'A senha deve possuir até 16 caracteres.',
            'password.required' => 'Campo Obrigatorio.',
            'image.mimes' => 'Insira um formato de imagem válido (jpeg,png ou jpg).',
            'image.image' => 'Insira uma imagem válida (jpeg,png ou jpg).',
            'document.cpf' => 'Cpf Invalido'
        ];
    }
}
