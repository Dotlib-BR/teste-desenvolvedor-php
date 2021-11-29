<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CadastroCandidatoRequest extends FormRequest
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
                    'candidato.nome' => 'required',
                    'candidato.sobrenome' => 'required',
                    'candidato.cpf' => 'required|unique:candidatos,cpf',
                    'candidato.data_nascimento' => 'required|date|date_format:d/m/y',
                    'cadidato.genero' => 'required|in:M,F,N',
                    'candidato.endereco' => 'required',
                    'candidato.telefone' => 'required',
                    'candidato.celular' => 'nullable',
                    'candidato.email' => 'nullable|email',

                    'usuario.nome' => 'required',
                    'usuario.email' => 'required|email',
                    'usuario.password' => 'required|confirmed'
                ];
            }


            case 'PATCH' : {
                return [
                    'candidato.nome' => 'required',
                    'candidato.sobrenome' => 'required',
                    'candidato.cpf' => [
                        'required',
                        'unique' => Rule::unique('candidatos', 'cpf')->ignore(request()->route('user_id'), 'user_id'),
                    ],
                    'candidato.data_nascimento' => 'required|date|date_format:Y-m-d',
                    'candidato.genero' => 'required|in:M,F,N',
                    'candidato.endereco' => 'required',
                    'candidato.telefone' => 'required',
                    'candidato.celular' => 'nullable',
                    'candidato.email' => 'nullable|email',

                    'usuario.nome' => 'required',
                    'usuario.email' => 'required|email',
                    'usuario.password' => 'nullable|confirmed'
                ];
            }
        }
    }

    public function messages(){

        return [
            'candidato.nome.required' => 'Nome do candidato é obrigatório',
            'candidato.sobrenome.required' => 'Sobrenome do candidato é obrigatório',
            'candidato.cpf.required' => 'CPF do candidato é obrigatório',
            'candidato.cpf.unique' => 'CPF já foi cadastrado',
            'candidato.data_nascimento.required' => 'Data de Nascimento é obrigatório',
            'candidato.data_nascimento.date' => 'Data de Nascimento deve ser uma data válida',
            'candidato.data_nascimento.date_format' => 'Formato data de nascimento é inválido',
            'candidato.genero.required' => 'O genêro é obrigatório',
            'candidato.genero.in' => 'Opção selecionada para o genêro é inválida',
            'candidato.endereco.required' => 'Endereço da empresa é obrigatório',
            'candidato.telefone.required' => 'Telefone da empresa é obrigatório',
            'candidato.email.email' => 'Formato de email da empresa é inválido',

            'usuario.nome.required' => 'Nome do usuário é obrigatório',
            'usuario.email.required' => 'Email do usuário é obrigatório',
            'usuario.email.email' => 'Formato de email do usuário é inválido',
            'usuario.password.confirmed' => 'Confirme a senha digitada',

        ];
    }
}
