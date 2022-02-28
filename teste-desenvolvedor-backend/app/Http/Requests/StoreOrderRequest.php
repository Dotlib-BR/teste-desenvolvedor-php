<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required|integer',
            'products' => 'required|min:1',
            'products.*' => 'required',
            'products.*.product_id' => 'required|integer',
            'products.*.quantity' => 'required|integer'
        ];
    }
}
