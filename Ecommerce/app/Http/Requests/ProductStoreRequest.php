<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name_product' => 'required|string|unique:products,name_product',
            'price' => 'required|numeric',
            'code' => 'numeric|required|unique:products,code',
            'discount' => 'numeric|nullable',
            'discount_status' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg|max:1920|nullable'
        ];
    }

    public function messages()
	{
		return [
            'name_product.required' => 'O nome do produto é obrigatório.',
            'name_product.unique' => 'Este nome já esta em uso.',
            'price.required' => 'O Preço é obrigatório.',
            'code.required' => 'O código de barras é obrigatório.',
            'code.unique' => 'Este código de barras já esta em uso.',
            'image.image' => 'Insira uma imagem válida (jpeg,png ou jpg).',
            'image.mimes' => 'Insira um formato de imagem válido (jpeg,png ou jpg).'
		];
	}
}
