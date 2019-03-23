<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
     * Modify the input values
     *
     * @return void
     */
    protected function prepareForValidation() 
    {
        if (! $this->wantsJson()) {
            $sessionOrder = $this->session()->get('cart.items');
            $removeKeys = ['name', 'price_full'];
            
            if ($this->session()->has('cart')) {
                $sessionOrder = array_remove_keys($sessionOrder, $removeKeys);
                $this->merge(['cart' => $sessionOrder]);
            }
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
            'number' => 'required|digits:5|unique:orders,number,' . $this->order->id,
            'client_id' => 'required|exists:clients,id',
            'status_id' => 'required|exists:statuses,id',
            'discount' => ($this->wantsJson() ? 'required|' : 'nullable|') . 'numeric|min:0',
            'cart' => 'required',
            'cart.*.product_id' => 'required|exists:products,id',
            'cart.*.quantity' => 'required|integer|not_in:0'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        if (! $this->wantsJson()) {
            return [
                'number.required' => 'Por favor, informe o número do pedido.',
                'number.digits' => 'Por favor, o número do pedido deve conter no máximo 5 digitos.',
                'number.unique' => 'Por favor, o número do pedido deve ser único.',
                'client_id.required' => 'Por favor, informe o cliente.',
                'client_id.exists' => 'Por favor, selecione um cliente existente.',
                'status_id.required' => 'Por favor, informe o status do pedido.',
                'status_id.exists' => 'Por favor, selecione um status existente.',
                'discount.numeric' => 'Por favor, o desconto deve ser um número.',
                'discount.min' => 'Por favor, o desconto deve ser um número positivo.',
                'cart.required' => 'Por favor, coloque produtos no carrinho antes de finalizar o pedido.',
                'cart.*.product_id.required' => 'Por favor, adicione produtos no carrinho antes de finalizar o pedido.',
                'cart.*.product_id.exists' => 'Por favor, adicione somente produtos existentes no sistema.',
                'cart.*.quantity.required' => 'Por favor, os produtos adicionados devem conter pelo menos 1 unidade.',
                'cart.*.quantity.integer' => 'Por favor, os produtos adicionados devem conter pelo menos 1 unidade.',
                'cart.*.quantity.not_in' => 'Por favor, os produtos adicionados devem conter pelo menos 1 unidade.',
            ];
        }

        return parent::messages();
    }
}
