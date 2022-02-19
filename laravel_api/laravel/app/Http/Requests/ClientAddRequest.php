<?php

namespace App\Http\Requests;

use App\Rules\DateBirth;
use App\Rules\FullName;
use Illuminate\Foundation\Http\FormRequest;

class ClientAddRequest extends FormRequest
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
            'name' => ['required', new FullName, 'max:45'],
            'email' => 'required|email|max:45|unique:clients',
            'date_birth' => ['required', new DateBirth],
            'cpf' => 'required|cpf|unique:clients',
            'phone' => 'required|min:14|max:14|celular_com_ddd',
            'stats' => 'required',
            'cep' => 'required|formato_cep|min:9|max:9',
            'address' => 'required|min:5|max:45',
            'complement' => 'required|min:2|max:45',
            'city' => 'required|min:4|max:20',
            'sex' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo NOME é obrigatório',
            'name.max' => 'Máximo de 45 caracteres atingido',
            'email.required' => 'O campo EMAIL é obrigatório',
            'email.email' => 'Email inválido',
            'email.max' => 'Máximo de 45 caracteres atingido',
            'email.unique' => 'Este email já está cadastrado',
            'date_birth.required' => 'O campo DATA DE NASCIMENTO é obrigatório',
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.cpf' => 'CPF inválido',
            'cpf.unique' => 'Este CPF já está cadastrado',
            'phone.required' => 'O campo TELEFONE é obrigatório',
            'phone.min' => 'Mínimo de 17 caracteres',
            'phone.max' => 'Máximo de 17 caracteres atingido',
            'stats.required' => 'O campo STATUS é obrigatório',
            'cep.required' => 'O campo CEP é obrigatório',
            'cep.min' => 'Mínimo de 9 caracteres',
            'cep.max' => 'Máximo de 9 caracteres atingido',
            'address.required' => 'O campo ENDEREÇO é obrigatório',
            'address.min' => 'Mínimo de 5 caracteres',
            'address.max' => 'Máximo de 45 caracteres atingido',
            'complement.required' => 'O campo COMPLEMENTO é obrigatório',
            'complement.min' => 'Mínimo de 2 caracteres',
            'complement.max' => 'Máximo de 45 caracteres atingido',
            'city.required' => 'O campo CIDADE é obrigatório',
            'city.min' => 'Mínimo de 4 caracteres',
            'city.max' => 'Máximo de 20 caracteres atingido',
            'sex.required' => 'O campo SEXO é obrigatório',
        ];
    }
}
