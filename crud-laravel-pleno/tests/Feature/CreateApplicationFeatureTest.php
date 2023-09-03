<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class CreateApplicationFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function can_create_application()
    {
        // Defina os dados do aplicativo (application)
        $applicationData = [
            // Defina os dados aqui
        ];

        // Envie uma solicitação POST para a rota de criação de aplicativos
        $response = $this->post(route('applications.store'), $applicationData);

        // Verifique se o status da resposta é 201 (Criado)
        $response->assertStatus(201);

        // Adicione asserções adicionais, se necessário
    }
}
