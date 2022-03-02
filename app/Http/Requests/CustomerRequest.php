<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'string|required',
            'cpf' => [
                'required',
                'string',
                'unique:App\Models\Customer,cpf' .
                    (
                        strtolower($this->method()) === 'post' ?
                        '' :
                        ',' . $this->route()->parameters()['customer']
                    )
            ],
            'email' => 'email|nullable',
        ];
    }
}
