<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Support\Str;

class CandidatoTest extends TestCase
{

    public function testAplicarParaVaga(){
        $loginData = ['email' => 'schmidt.malvina@example.org', 'password' => '123456'];
        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $vaga = rand(15, 130);
        $this->json('POST', "api/v1/candidato/vaga/$vaga/inscrever", ['curriculo' => UploadedFile::fake()->image(Str::random(15).'.pdf')],  ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200);
    }

    public function testVagasAplicadas(){
        $loginData = ['email' => 'schmidt.malvina@example.org', 'password' => '123456'];
        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $vaga = rand(15, 130);
        $this->json('GET', "api/v1/candidato/minhas-inscricoes", ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200);
    }
}
