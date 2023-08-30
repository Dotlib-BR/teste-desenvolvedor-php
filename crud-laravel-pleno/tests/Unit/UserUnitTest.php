<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserUnitTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function criar_usuario()
    {
        $dadosUsuario = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'nivel_acesso' => ('Usuario'),
        ];

        $usuario = User::create($dadosUsuario);

        $this->assertInstanceOf(User::class, $usuario);
        $this->assertSame($dadosUsuario['name'], $usuario->name);
    }

    /** @test */
    public function atualizar_usuario()
    {
        $usuario = User::factory()->create();

        $novosDados = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('newpassword'),
            'nivel_acesso' => ('Admin'),
        ];

        $usuario->update($novosDados);

        $this->assertSame($novosDados['name'], $usuario->name);
        $this->assertSame($novosDados['email'], $usuario->email);
    }

    /** @test */
    public function excluir_usuario()
    {
        $usuario = User::factory()->create();

        $usuario->delete();

        $this->assertDatabaseMissing('users', ['id' => $usuario->id]);
    }

    /** @test */
    public function recuperar_usuario()
    {
        $usuario = User::factory()->create();

        $usuarioRecuperado = User::find($usuario->id);

        $this->assertInstanceOf(User::class, $usuarioRecuperado);
        $this->assertSame($usuario->name, $usuarioRecuperado->name);
    }
}
