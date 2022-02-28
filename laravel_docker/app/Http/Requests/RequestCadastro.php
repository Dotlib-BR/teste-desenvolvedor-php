<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCadastro extends FormRequest
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
            'nome_usuario' => 'required | string | min:10 | max:255',
            'cpf_usuario' => 'required | int | min:10',
            'email_usuario' => 'required | string | min:10 | max:255',
            'senha_usuario' => 'required | string | min:2 | max:45',
            'autoridade_usuario' => 'required | int | max:3'
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
            'nome_usuario.string' => 'Por favor, insira um email válido',
            'nome_usuario.min' => 'Somente são válidos emails acima de 10 caracteres',
            'nome_usuario.max' => 'Somente são válidos emails com menos de 255 caracteres',
            'cpf_usuario.int' => 'Por favor, insira um email válido',
            'cpf_usuario.min' => 'Por favor, insira um email válido',
            'email_usuario.required' => 'É necessário um email',
            'email_usuario.string' => 'Por favor, insira um email válido',
            'email_usuario.min' => 'Somente são válidos emails acima de 10 caracteres',
            'email_usuario.max' => 'Somente são válidos emails com menos de 255 caracteres',
            'senha_usuario.required' => 'É necessário uma senha',
            'senha_usuario.string' => 'Por favor, insira uma senha válida',
            'senha_usuario.min' => 'Somente são válidas senhas acima de 8 caracteres',
            'senha_usuario.max' => 'Somente são válidas senhas com menos de 45 caracteres',
            'autoridade_usuario.required' => 'Determine o level de autoridade do cadastro'
        ];
    }
}
