<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'name' => 'nullable|max:100',
            'price' => 'required|numeric',
            'bar_code' => 'required|digits:20',
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
            'name.max' => 'Por favor, informe um nome com no máximo 100 caracteres.',
            'price.required' => 'Por favor, informe um preço.',
            'price.numeric' => 'O preço informado não é um número válido.',
            'bar_code.required' => 'Por favor, informe um código de barras.',
            'bar_code.digits' => 'O código de barras deve conter no máximo 20 digitos.',
        ];
    }
}
