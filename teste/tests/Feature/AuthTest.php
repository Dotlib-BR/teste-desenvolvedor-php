<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;//para dar um "rollback" quando inserir algo no banco, de forma automática!

    /**
     * Testar se tem o formulário de login do usuário.
     *
     * @return void
     */
    public function testFormLogin()
    {
        $response = $this->get('/');

        $response->assertSuccessful();//status code 200
        $response->assertViewIs('auth.login');//view que possui o formulário de login

        $response = $this->get('/login');//padrão do make:auth

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /**
     * Testar se o usuário autenticado está sendo redirecionado ao acessar o formulário de login
     *
     * @return void
     */
    public function tesRedirectIftAuthenticated()
    {
        $response = $this->actingAs(User::first())
            ->get('/login');
        // actingAs método para autenticar usuário

        $response->assertRedirect('/dashboard/home');

        $response = $this->actingAs(User::first())
            ->get('/');//também deve redirecionar

        $response->assertRedirect('/dashboard/home');
    }

    /**
     * Testar sucesso na autenticação de um usuário.
     *
     * @return void
     */
    public function testAuthenticationSuccess()
    {
        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        $user = User::wherePassword($password)
            ->first();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard/home');

        $this->assertAuthenticatedAs($user);
    }

    /**
     * Testar falha na autenticação de um usuário.
     *
     * @return void
     */
    public function testAuthenticationFailure()
    {
        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        $user = User::wherePassword($password)
            ->first();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalid',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');//afirma que na sessão tem o erro de email

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();//afirma que o usuário não está autenticado
    }

    /**
     * Testar se tem o formulario de redefinir senha
     *
     * @return void
     */
    public function testFormPasswordReset()
    {
        $response = $this->get('/password/reset');

        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.email');
    }

    /**
     * Testar sucesso no redefinir minha senha.
     *
     * @return void
     */
    public function testResetPasswordSuccess()
    {
        $user = User::first();

        $response = $this->post('/password/email', [
            'email' => $user->email,
        ]);

        $response->assertSessionHasNoErrors();
        //Ver se tem alguma sessão de erro.

        $this->assertEquals(
            'Enviamos um link para redefinir a sua senha por e-mail.',
            session('status')
        );//Testa se a mensagem de sucesso é a experada.
    }
    /**
     * Testar falha no redefinir minha senha.
     *
     * @return void
     */
    public function testResetPasswordFailure()
    {
        $response = $this->post('/password/email', [
            'email' => 'teste@notexists.com',
        ]);

        $response->assertSessionHasErrors('email');//afirma que na sessão tem o erro de email

        $this->assertTrue(session()->hasOldInput('email'));
    }


    /**
     * Testar se tem o formulario de cadastro do usuário.
     *
     * @return void
     */
    public function testFormRegister()
    {
        $response = $this->get('/register');

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    /**
     * Testar sucesso no cadastro do usuário.
     *
     * @return void
     */
    public function testRegisterSuccess()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'teste@success.br',
            'password' => '123456789',
            'password_confirmation' => '123456789',
        ]);

        $response->assertSessionDoesntHaveErrors([
            'name', 'email',
            'password', 'password_confirmation'
        ]);
        $response->assertRedirect('/dashboard/home');

        $this->assertAuthenticated();//afirma que usuário está autenticado.
    }

    /**
     * Testar falha no cadastro do usuário.
     *
     * @return void
     */
    public function testRegisterFailure()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'teste@success.br',
            'password' => '123',//parar na validação pois o mínimo é 8 caracteres.
            'password_confirmation' => '123',
        ]);

        $response->assertSessionHasErrors(['password']);

        $response->assertRedirect('/');

        $this->assertGuest();
    }
}
