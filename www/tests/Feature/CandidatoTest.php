<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vaga;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CandidatoTest extends TestCase
{
    use DatabaseTransactions;

    public function testAplicarParaVaga(){

        $user = User::where('perfil', '=', 'candidato')->first();
        $loginData = ['email' => $user->email, 'password' => '123456'];
        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $vaga = Vaga::inRandomOrder()->take(1)->first();

        $curriculoFilename = $user->nome.'-'.time().'.pdf';

        $this->json('POST', "api/v1/candidato/vaga/$vaga->id/inscrever", ['curriculo' => UploadedFile::fake()->create($curriculoFilename, 2048) ],  ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200);
    }

    public function testVagasAplicadas(){
        $user = User::where('perfil', '=', 'candidato')->first();
        $loginData = ['email' => $user->email, 'password' => '123456'];

        $response = $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)->assertJsonStructure(["token"]);

        $token = $response->decodeResponseJson()['token'];

        $vaga = rand(15, 130);
        $this->json('GET', "api/v1/candidato/minhas-inscricoes", ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$token])
            ->assertStatus(200);
    }
}
