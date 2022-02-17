<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidosRequest extends FormRequest
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
            'data_pedido' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'data_pedido.required' => 'O campo QUANTIDADE é obrigatório', 
            'status.required' => 'O campo STATUS é obrigatório', 
        ];
    }
}
