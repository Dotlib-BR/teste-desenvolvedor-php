<?php

namespace Tests\Feature;

use App\Models\Tecnologia;
use App\Models\User;
use App\Models\Vaga;
use Tests\TestCase;

class VagaTest extends TestCase
{

    protected $token;


    public function testVagaCreate()
    {

        $user = User::where('perfil', '=', 'empresa')->first();
        $loginData = ['email' => $user->email, 'password' => '123456'];

        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $tec = Tecnologia::inRandomOrder()->take(5)->get();

        $vagaData = [
            'empresa_id' => $user->empresa->id,
            'titulo' => 'Teste de caso',
            'slug' => 'teste-de-caso',
            'nivel' => 'pleno',
            'categoria' => 'CLT',
            'regime' => 'remoto',
            'salario' => 4952.45,
            'descricao' => 'Fazendo testes de caso',
            'is_paused' => 0,

            'tecnologias' => $tec->pluck('id'),
        ];

        $this->json('POST', 'api/v1/empresa/vagas', $vagaData, ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testListVaga(){

        $user = User::where('perfil', '=', 'empresa')->first();
        $loginData = ['email' => $user->email, 'password' => '123456'];

        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $this->json('GET', 'api/v1/empresa/vagas', ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200);
    }

    public function testShowVaga(){

        $user = User::where('perfil', '=', 'empresa')->first();
        $loginData = ['email' => $user->email, 'password' => '123456'];

        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $this->json('GET', 'api/v1/empresa/vagas', ['vaga' => 26], ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200);
    }

    public function testPauseVaga(){

        $user = User::where('perfil', '=', 'empresa')->first();
        $loginData = ['email' => $user->email, 'password' => '123456'];

        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $vaga_id = Vaga::where('empresa_id', '=', $user->empresa->id)->inRandomOrder()->take(1)->first()->id;

        $this->json('PATCH', "api/v1/empresa/vagas/$vaga_id/pause", ['pause' => 1], ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200);
    }

}
