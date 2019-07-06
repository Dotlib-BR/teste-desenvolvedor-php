<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateClientFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()//se false = 403 This action is unauthorized.
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
        $client = null;
        // Vai armazenar o id do cliente caso seja método update e null se não, para não quebrar a validação

        if ($this->segment(3)) {// É a posição da url onde está o id do cliente
            // Dessa forma eu consigo usar a mesma validação tanto para o store quanto para o update.

            $client = $this->segment(3);
        }

        return [
            'name' => 'required|max:255',
            'cpf' => "required|max:11|unique:clients,cpf,{$client},id",
            'email' => "sometimes|nullable|max:255|email|unique:clients,email,{$client},id"
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['cpf'=>
            str_replace(
                '.', '', str_replace('-', '', $this->request->get('cpf'))
            )
        ]);// Para retirar a máscara do CPF antes de válidar se existe no banco.
    }

    public function messages()
    {
        return [
            'name.required' => 'O Nome é obrigatório.',
            'name.max' => 'O Nome deve possuir no máximo 255 caracteres.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.max' => 'O CPF deve possuir no máximo 14 caracteres.',
            'cpf.unique' => 'CPF já está cadastrado.',
            'email.max' => 'O Email deve possuir no máximo 255 caracteres.',
            'email.email' => 'O Email não possui formato de um Email válido.',
            'email.unique' => 'Email já está cadastrado.'
        ];
    }
}
