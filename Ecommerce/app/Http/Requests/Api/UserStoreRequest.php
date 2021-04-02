<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'unique:users,email|required',
            'document' => 'unique:users,document|required|cpf',
            'password' => 'min:6|max:16|required',
            'image' => 'image|mimes:jpeg,png,jpg|max:1920|nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'last_name.required' => 'Last name is required',
            'email.unique' => 'E-mail already registered',
            'email.required' => 'E-mail is required.',
            'document.unique' => 'CPF already registered.',
            'document.required' => 'Document is required.',
            'document.cpf' => 'Invalid Cpf.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must have 6 or more characters',
            'password.max' => 'Password must have up to 16 characters',
            'image.mimes' => 'Enter a valid image format (jpeg,png ou jpg).',
            'image.image' => 'Enter a valid image file (jpeg,png ou jpg).',
        ];
    }

    protected function failedValidation(Validator $validator)
	{
		$errors = (new ValidationException($validator))->errors();
		$errors = str_replace("\n", ". \n", implode("\n" , array_map(function ($arr) {
			return implode("\n" , $arr);
		}, $errors)));
		throw new HttpResponseException(
			response()->json(['error' => 1, 'description' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
		);
    }
}
