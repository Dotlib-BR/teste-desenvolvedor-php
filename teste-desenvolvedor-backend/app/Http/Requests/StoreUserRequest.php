<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'cpf' => 'required|string|max:255',
        ];
    }

    /**
     * @return array
     */
    public function bodyParameters(): array {
        return [
            'name' => [
                'description' => 'Nome do usuário',
                'example' => 'Jose Almeida'
            ],
            'email' => [
                'description' => 'Email do usuário',
                'example' => 'cliente@dotlib.com'
            ],
            'password' => [
                'description' => 'Senha do usuário',
                'example' => '12345678'
            ],
            'cpf' => [
                'description' => 'CPF do usuário',
                'example' => '12345678901'
            ]
        ];
    }
}
