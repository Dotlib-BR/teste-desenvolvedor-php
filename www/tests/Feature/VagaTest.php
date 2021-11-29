<?php

namespace Tests\Feature;

use Tests\TestCase;

class VagaTest extends TestCase
{

    protected $token;


    public function testVagaCreate()
    {
        $loginData = ['email' => 'effertz.nannie@example.org', 'password' => '123456'];
        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $vagaData = ['empresa_id' => rand(2, 10), 'titulo' => 'Teste de caso', 'slug' => 'teste-de-caso', 'nivel' => 'pleno', 'categoria' => 'CLT', 'regime' => 'remoto', 'salario' => 4952.45, 'descricao' => 'Fazendo testes de caso', 'is_paused' => 0];

        $this->json('POST', 'api/v1/empresa/vagas', $vagaData, ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testListVaga(){
        $loginData = ['email' => 'effertz.nannie@example.org', 'password' => '123456'];
        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $this->json('GET', 'api/v1/empresa/vagas', ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200);
    }

    public function testShowVaga(){
        $loginData = ['email' => 'effertz.nannie@example.org', 'password' => '123456'];
        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $this->json('GET', 'api/v1/empresa/vagas', ['vaga' => 26], ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200);
    }

    public function testPauseVaga(){
        $loginData = ['email' => 'effertz.nannie@example.org', 'password' => '123456'];
        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $this->json('PATCH', 'api/v1/empresa/vagas/129/pause', ['pause' => 0], ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200);
    }

}
