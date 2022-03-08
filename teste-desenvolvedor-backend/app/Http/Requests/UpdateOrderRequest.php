<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'client_id' => 'integer',
            'total_price' => 'string',
            'product_id' => 'array',
        ];
    }

    /**
     * @return array
     */
    public function bodyParameters(): array
    {
        return [
            'client_id' => [
                'description' => 'ID do Cliente',
                'example' => '1'
            ],
            'products' => [
                'description' => 'Lista de produtos',
                'example' => 'product_id: 1, quantity: 2'
            ]
        ];
    }
}
