<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoAddRequest extends FormRequest
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
            'client' => 'required',
            'product' => 'required',
            'amount' => 'required',
            'date_pedido' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'client.required' => 'O campo CLIENTE é obrigatório',
            'product.required' => 'O campo PRODUTO é obrigatório',
            'amount.required' => 'O campo AMOUNT é obrigatório',
            'date_pedido.required' => 'O campo Data do Pedido é obrigatório',
        ];
    }
}
