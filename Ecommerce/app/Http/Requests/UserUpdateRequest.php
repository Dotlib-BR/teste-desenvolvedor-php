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
            'email' => 'unique:users,email',
            'password' => 'min:6|max:16',
            'image' => 'image|mimes:jpeg,png,jpg|max:1920|nullable'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'E-mail já existente, por favor insira outro',
            'password.min' => 'A senha deve possuir 6 ou mais caracteres',
            'password.max' => 'A senha deve possuir até 16 caracteres',
            'image.mime' => 'Insira um formato de imagem válido (jpeg,png ou jpg).',
            'image.image' => 'Insira uma imagem válida (jpeg,png ou jpg).'
        ];
    }
}
