<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'string|max:255',
            'email' => 'string|max:255',
            'password' => 'string|max:255',
            'cpf' => 'string|max:255',
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
