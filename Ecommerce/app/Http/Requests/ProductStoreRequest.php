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
            'discount' => 'numeric|nullable|max:10|min:10',
            'discount_status' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg|max:1920|nullable'
        ];
    }

    public function messages()
	{
		return [
            'name_product.required' => 'The product name is required.',
            'name_product.unique' => 'This name is already in use.',
            'price.required' => 'The price is required.',
            'code.required' => 'The barcode is required.',
            'code.unique' => 'This barcode is already in use.',
            'image.image' => 'Enter a valid image file (jpeg,png ou jpg).',
            'image.mimes' => 'Enter a valid image format (jpeg,png ou jpg).'
		];
	}
}
