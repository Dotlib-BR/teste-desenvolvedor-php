<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestLogin extends FormRequest
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
            // 'email' => 'required | string | min:10 | max:255',
            // 'password' => 'required | string | min:8 | max:45'
        ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'É necessário um email',
            'email.string' => 'Por favor, insira um email válido',
            'email.min' => 'Somente são válidos emails acima de 10 caracteres',
            'email.max' => 'Somente são válidos emails com menos de 255 caracteres',
            'password.required' => 'É necessário uma senha',
            'password.string' => 'Por favor, insira uma senha válida',
            'password.min' => 'Somente são válidas senhas acima de 8 caracteres',
            'password.max' => 'Somente são válidas senhas com menos de 45 caracteres',
        ];
    }
}
