<?php


namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|string",
            "last_name" => "required|string",
            "email" => "required|string",
            'password' => 'required|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            "required" => "Este campo é obrigatório.",
            "string" => "Este campo deve ser do tipo texto.",
            "password.required" => "A senha é obrigatória",
            "password.min" => "A senha requer no mínimo 6 carateres",
            "confirmed" => "As senhas não conferem"
        ];
    }
}
