<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'price' => 'required|string',
            "bar_code" => 'integer',
        ];
    }

    /**
     * @return array
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Nome do produto',
                'example' => 'Livro de Laravel'
            ],
            'price' => [
                'description' => 'Preço do produto',
                'example' => 'R$ 10,00'
            ],
            'bar_code' => [
                'description' => 'Código de barras do produto',
                'example' => '1234567890123'
            ]
        ];
    }
}
