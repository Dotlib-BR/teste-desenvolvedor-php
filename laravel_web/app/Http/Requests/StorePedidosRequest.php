<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidosRequest extends FormRequest
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
            'cliente' => 'required',
            'produto' => 'required',
            'quantidade' => 'required',
            'data_pedido' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cliente.required' => 'O campo CLIENTE é obrigatório', 
            'produto.required' => 'O campo PRODUTO é obrigatório', 
            'quantidade.required' => 'O campo QUANTIDADE é obrigatório', 
            'data_pedido.required' => 'O campo QUANTIDADE é obrigatório', 
        ];
    }
}
