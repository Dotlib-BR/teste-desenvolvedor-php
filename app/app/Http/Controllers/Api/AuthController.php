<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|string|confirmed',
            'token_name' => 'required|string'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken($request->token_name);

        return ['token' => $token->plainTextToken];
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'token_name' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials',
            ]);
        }

        $token = $user->createToken($request->token_name);
        return ['token' => $token->plainTextToken];
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Logged out'
        ]);
    }
}
