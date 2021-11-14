<?php


namespace App\Http\Requests;

use App\Http\Requests\Request;

class VagaRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "titulo" => "required|string",
            "descricao" => "required|string",
            "requisito_obrigatorio" => "required|string",
            "tipo_contratacao_id" => "required|string"
        ];
    }

    public function messages()
    {
        return [
            "required" => "Este campo é obrigatório.",
            "string" => "Este campo deve ser do tipo texto.",
        ];
    }
}
