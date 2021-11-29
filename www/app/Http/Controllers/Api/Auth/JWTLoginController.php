<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTLoginController extends Controller
{
    public function login(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $messages = [
            'email.required' => 'Você precisa informar um email válido.',
            'password.required' => 'É preciso informar uma senha.'
        ];


        $this->validate($request, $rules, $messages);

        $credentials = $request->all(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json('Unauthorized', 401);
        }

        return response()->json([
            'token' => $token,
        ]);
    }

    public function me(){
        return response()->json(['user' => auth('api')->user()], 200);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Você foi deslogado!'], 200);
    }

    public function refresh()
    {
        $token = JWTAuth::getToken();

        if(!$token){
            throw new BadRequestHttpException('O token não foi fornecido');
        }

        try{
            $token = JWTAuth::refresh($token);
        }catch(TokenInvalidException $e){
            throw new AccessDeniedHttpException('Token inválido');
        }

        return response()->json([
            'token'=>$token
        ]);
    }

    public function user(){

        try {
            $user = JWTAuth::parseToken()->authenticate();
            return response()->json( ['user' => $user] , 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Algo deu errado'], 500);

        }
    }
}
