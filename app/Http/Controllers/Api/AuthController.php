<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->only([
            'email',
            'password'
        ]);
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'email.unique' => 'E-mail já cadastrado',
            'email.email' => 'E-mail informado não é válido',
        ];

        $validation = $this->validation($data, $rules, $feedback);

        if ($validation->fails()) {
            return response()->json(['erros'=>$validation]);
        }

        $token = auth('api')->attempt($data);
        if ($token) {
            return response()->json(['token' => $token],200);
        } else {
            return response()->json(['erros' => 'Email e/ou senha errados'],403);
        }

    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['msg'=>'Logout realizado com sucesso']);
    }

    public function refresh()
    {
       $token = auth('api')->refresh();
       return response()->json(['token'=>$token]);
    }

    public function me()
    {
        return response()->json(auth()->user(),200);
    }

    protected function validation(array $data, array $rules, array $feedback)
    {
        return Validator::make($data, $rules, $feedback);
    }
}
