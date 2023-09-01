<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'                  => 'required|unique:users,name',
            'email'                 => 'required|email:rfc,dns|unique:users,email',
            'username'              => 'required|unique:users,username',
            'level'                 => 'required',
            'status'                => 'required',
            'token'                 => 'required',
            'password'              => 'required|min:4',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
