<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePurchaseFormRequest extends FormRequest
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
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|numeric',
            'discount_id' => 'sometimes|nullable|exists:discounts,id',
            'status_id' => 'required|exists:statuses,id',
            'client_id' => 'required|exists:clients,id'
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->request->get('discount_id') == 0) {
            $this->request->remove('discount_id');
        }

        if ($this->request->get('status_id') == 0) {
            $this->request->remove('status_id');
        }

        if ($this->request->get('client_id') == 0) {
            $this->request->remove('client_id');
        }
    }

    public function messages()
    {
        return [
            'product_id.*.required' => 'O produto é obrigatório.',
            'product_id.*.exists' => 'O produto deve existir na tabela de produtos.',
            'quantity.*.required' => 'A quantidade é obrigatória.',
            'quantity.*.numeric' => 'A quantidade deve ser um valor numérico.',
            'discount_id.exists' => 'O desconto deve existir na tabela de descontos.',
            'status_id.required' => 'O status é obrigatório.',
            'status_id.exists' => 'O status selecionado não existe.',
            'client_id.required' => 'O cliente é obrigatório.',
            'client_id.exists' => 'O cliente deve existir na tabela de clientes.',
        ];
    }
}
