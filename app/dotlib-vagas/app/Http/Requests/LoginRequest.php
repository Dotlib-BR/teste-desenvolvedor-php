<?php


namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "email" => "required",
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            "required" => "Este campo é obrigatório.",
        ];
    }
}
