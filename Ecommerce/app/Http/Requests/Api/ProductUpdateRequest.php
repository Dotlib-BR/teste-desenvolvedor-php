<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name_product' => 'string',
            'price' => 'numeric',
            'discount' => 'numeric|nullable|max:100|min:0',
            'discount_status' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg|max:1920|nullable'
        ];
    }

    public function messages()
	{
		return [
            'image.image' => 'Enter a valid image file (jpeg,png ou jpg).',
            'image.mimes' => 'Enter a valid image format (jpeg,png ou jpg).'
		];
	}
}
