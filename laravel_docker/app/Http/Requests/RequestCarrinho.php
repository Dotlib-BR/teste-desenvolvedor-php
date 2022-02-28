<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RequestCarrinho extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        // Verificando se o usuário está logado
        if ($request->session()->get('usuarioLogado') == true && is_int($request->session()->get('usuarioId')) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'produto_id' => 'required | int | between:1,150',
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
            'produto_id.required' => 'Por favor, verifique o produto que tentou adicionar ao carrinho',
            'produto_id.int' => 'Por favor, verifique o id do produto',
            'produto_id.between' => 'Por favor, insira um id do produto válido. Entre 1 e 150'
        ];
    }
}
