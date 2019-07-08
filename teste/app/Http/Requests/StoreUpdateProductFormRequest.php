<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()//se false = 403 This action is unauthorized.
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
        $product = null;

        if ($this->segment(3)) {// É a posição da url onde está o id do produto
            // Dessa forma eu consigo usar a mesma validação tanto para o store quanto para o update.

            $product = $this->segment(3);
        }

        return [
            'name' => 'required|max:255',
            'barcode' => "required|max:255|unique:products,barcode,{$product},id",
            'price' => 'required|max:20'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'price' => convertBrlToDecimal( $this->request->get('price'))
        ]);

        $this->merge([
            'barcode' => str_replace(' ', '', $this->request->get('barcode'))
        ]);
    }

    public function messages()
    {
        return [
            'name.required' => 'O Nome é obrigatório.',
            'name.max' => 'O Nome deve possuir no máximo 255 caracteres.',
            'barcode.required' => 'O Código de barras é obrigatório.',
            'barcode.max' => 'O Código de barras deve possuir no máximo 255 caracteres.',
            'barcode.unique' => 'Código de barras já está cadastrado.',
            'price.required' => 'O Nome é obrigatório.'
        ];
    }
}
