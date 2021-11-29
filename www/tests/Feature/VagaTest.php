<?php

namespace Tests\Feature;

use App\Models\Tecnologia;
use App\Models\User;
use App\Models\Vaga;
use Tests\TestCase;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

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

        $tecnologias = "1, 3, 5, 15";

        $faker = Faker::create();
        $title = $faker->text(25);

        $vagaData = [
            'empresa_id' => $user->empresa->id,
            'titulo' => $title,
            'slug' => Str::slug($title),
            'nivel' => $faker->randomElement(['junior', 'pleno', 'senior']),
            'categoria' => $faker->randomElement(['CLT', 'PJ', 'Freelancer']),
            'regime' => $faker->randomElement(['remoto', 'presencial']),
            'salario' => $faker->randomFloat(2, 2500, 10000),
            'descricao' => '<p>'.$faker->text(1000).'</p>',
            'is_paused' => $faker->numberBetween(0,1),

            'tags' => $tecnologias,
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
