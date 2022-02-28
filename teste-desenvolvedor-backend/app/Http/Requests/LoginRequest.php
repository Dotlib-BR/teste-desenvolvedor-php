<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class LoginRequest extends FormRequest
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
            'email' => 'string|required|email|max:255',
            'password' => 'string|required|min:8|max:255',
        ];
    }

    public function bodyParameters(): array {
        return [
            'email' => [
                'description' => 'E-mail do usuário',
                'example' => 'cliente@email.com'
            ],
            'password' => [
                'description' => 'Senha em plaintext',
                'example' => '12345678'
            ]
        ];
    }
}
