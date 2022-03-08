<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code' => [
                'required',
                'string',
                'unique:App\Models\Product,code' .
                    (
                        strtolower($this->method()) === 'post' ?
                        '' :
                        ',' . $this->route()->parameters()['product']
                    )
            ],
            'name' => 'string|required',
            'warehouse_quantity' => 'required|integer',
            'value' => 'required|numeric',
        ];
    }
}
