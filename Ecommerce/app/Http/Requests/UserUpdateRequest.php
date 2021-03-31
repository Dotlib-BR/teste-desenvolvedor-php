<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'string',
            'last_name' => 'string',
            'password' => 'min:6|max:16|nullable',
            'image' => 'image|mimes:jpeg,png,jpg|max:1920|nullable'
        ];
    }

    public function messages()
    {
        return [
            'password.min' => 'Password must have 6 or more characters',
            'password.max' => 'Password must have up to 16 characters',
            'image.mimes' => 'Enter a valid image format (jpeg,png ou jpg).',
            'image.image' => 'Enter a valid image file (jpeg,png ou jpg).'
        ];
    }
}
