<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    public function testEmailPasswordValidation()
    {
        $this->json('POST', 'api/v1/auth/login', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    'email' => ["Você precisa informar um email válido."],
                    'password' => ["É preciso informar uma senha."],
                ]
            ]);
    }

    public function testLoginSuccess()
    {
        $user = User::first();
        $loginData = ['email' => $user->email, 'password' => '123456'];

        $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json'])
        ->assertStatus(200)->assertJsonStructure(["token"]);

        $this->assertAuthenticated('api');
    }

    public function testGetAuthenticationUser(){
        $this->json('GET', 'api/v1/auth/me')
            ->assertStatus(200)
            ->assertJsonStructure([
                "user"
            ]);
    }

    public function testGetUserByToken(){

        $user = User::first();

        $loginData = ['email' => $user->email, 'password' => '123456'];
        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $this->get('api/v1/auth/user', ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
        ->assertStatus(200)
        ->assertJsonStructure([
            "user"
        ]);
    }
}
