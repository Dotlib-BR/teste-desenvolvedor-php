<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CadastroEmpresaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        switch($this->method())
        {
            case 'POST': {
                return [
                    'empresa.nome' => 'required',
                    'empresa.cnpj' => 'required|unique:empresas,cnpj',
                    'empresa.endereco' => 'required',
                    'empresa.telefone' => 'required',
                    'empresa.celular' => 'nullable',
                    'empresa.email' => 'nullable|email',

                    'usuario.nome' => 'required',
                    'usuario.email' => 'required|email',
                    'usuario.password' => 'required|confirmed'
                ];
            }


            case 'PATCH' : {
                return [
                    'empresa.nome' => 'required',
                    'empresa.cnpj' => [
                        'required',
                        'unique' => Rule::unique('empresas', 'cnpj')->ignore(request()->route('user_id'), 'user_id'),
                    ],
                    'empresa.endereco' => 'required',
                    'empresa.telefone' => 'required',
                    'empresa.celular' => 'nullable',
                    'empresa.email' => 'nullable|email',

                    'usuario.nome' => 'required',
                    'usuario.email' => 'required|email',
                    'usuario.password' => 'nullable|confirmed'
                ];
            }
        }
    }

    public function messages(){

        return [
            'empresa.nome.required' => 'Nome da empresa é obrigatório',
            'empresa.cnpj.required' => 'CNPJ da empresa é obrigatório',
            'empresa.cnpj.unique' => 'CNPJ já foi cadastrado',
            'empresa.endereco.required' => 'Endereço da empresa é obrigatório',
            'empresa.telefone.required' => 'Telefone da empresa é obrigatório',
            'empresa.email.email' => 'Formato de email da empresa é inválido',
            'usuario.nome.required' => 'Nome do usuário é obrigatório',
            'usuario.email.required' => 'Email do usuário é obrigatório',
            'usuario.email.email' => 'Formato de email do usuário é inválido',
            'usuario.password.confirmed' => 'Confirme a senha digitada',

        ];
    }
}
