<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoUpdateRequest extends FormRequest
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
            'date_pedido' => 'required',
            'stats' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date_pedido.required' => 'O campo Data do Pedido é obrigatório',
            'stats.required' => 'O campo STATUS é obrigatório',
        ];
    }
}
