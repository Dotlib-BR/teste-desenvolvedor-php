<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthControllerTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * @test
     */
    public function verifica_index_auth_acessar()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function verifica_index_auth_autenticado_redirecionar()
    {
        $user = User::first();
        Auth::login($user);

        $response = $this->get('/')
            ->assertRedirect('/vagas');
    }

    /**
     * @test
     */
    public function verifica_register_auth_acessar()
    {
        $response = $this->get('/auth/register');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function verifica_store_auth_salvar_dados()
    {
        Session::start();
        $userFactory = new UserFactory();
        $userFake = $userFactory->definition();

        $response = $this->call('POST', '/auth/store',
            [
                '_token' =>csrf_token(),
                'name' => $userFake['name'],
                'email' => $userFake['email'],
                'password' => '123456',
                'password_confirmation' => '123456',
            ]
        )->assertRedirect('/');

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function verifica_login_auth_logar()
    {
        Session::start();
        $userFake = User::factory(1)->create(['password' => Hash::make('123456')]);

        $this->call('POST', '/auth/login',
            [
                '_token' => csrf_token(),
                'email' => $userFake[0]->email,
                'password' => '123456',
            ]
        )->assertRedirect('/vagas');
    }

    /**
     * @test
     */
    public function verifica_login_auth_falha()
    {
        Session::start();
        $userFake = User::factory(1)->create(['password' => Hash::make('123456')]);

        $this->call('POST', '/auth/login',
            [
                '_token' => csrf_token(),
                'email' => $userFake[0]->email,
                'password' => '1234561000',
            ]
        )->assertRedirect('/');
    }

    /**
     * @test
     */
    public function verifica_logout_auth_deslogar()
    {
       $this->get('/auth/logout')->assertRedirect('/');

    }
}
