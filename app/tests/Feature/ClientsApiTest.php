<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class ClientsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_clients_route_require_a_per_page_value()
    {
        $this->get('/api/clients')
            ->assertSessionHasErrors('per_page');
    }

    public function test_get_all_clients_route_return_the_number_of_items_specified_on_per_page_param()
    {
        Client::factory()->count(20)->create();

        $response = $this->get('/api/clients?per_page=15');
        $content = $response->decodeResponseJson();
        $this->assertCount(15, $content['data']);
        $this->assertEquals(20, $content['total']);
    }

    public function test_get_specific_client_route_requre_a_valid_client_id()
    {
        Client::factory()->create();
        $resposne = $this->get('/api/clients/2')
            ->assertStatus(404);
    }

    public function test_get_specific_client_route_works_fine()
    {
        $client = Client::factory()->create();
        $content = $this->get("/api/clients/$client->id")
            ->decodeResponseJson();
        $this->assertEquals($content['id'], $client->id);
    }

    public function test_create_client_route_validate_the_request_data()
    {
        $this->post('/api/clients', [])
            ->assertSessionHasErrors(['name', 'cpf', 'email']);
    }

    public function test_create_client_route_cannot_create_clients_with_duplicated_cpf_and_email()
    {
        Client::factory([
            'cpf' => '77777777777',
            'email' => 'henriborgessilva@gmail.com',
        ])->create();

        $this->post('/api/clients', [
            'name' => 'henri',
            'cpf' => '77777777777',
            'email' => 'henriborgessilva@gmail.com',
        ])->assertSessionHasErrors(['cpf', 'email']);
    }

    public function test_create_client_route_works_fine()
    {
        $this->post('/api/clients', [
            'name' => 'henri',
            'cpf' => '77777777777',
            'email' => 'henriborgessilva@gmail.com',
        ])->assertStatus(201);
    }

    public function test_update_client_route_works_fine()
    {
        $client = Client::factory()->create();

        $this->put("/api/clients/$client->id", [
            'name' => 'henri'
        ])->assertStatus(200);
    }

    public function test_create_and_update_routes_need_a_cpf_with_11_digits()
    {
        $this->post('/api/clients', [
            'name' => 'henri',
            'cpf' => '77777',
            'email' => 'henriborgessilva@gmail.com',
        ])->assertSessionHasErrors(['cpf']);

        $client = Client::factory()->create();

        $this->put("/api/clients/$client->id", [
            'cpf' => '77777',
        ])->assertSessionHasErrors(['cpf']);
    }

    public function test_create_and_update_routes_need_a_valid_email_format()
    {
        $this->post('/api/clients', [
            'name' => 'henri',
            'cpf' => '77777777777',
            'email' => 'henriborg431324',
        ])->assertSessionHasErrors(['email']);

        $client = Client::factory()->create();

        $this->put("/api/clients/$client->id", [
            'email' => 'henri234187412987512',
        ])->assertSessionHasErrors(['email']);
    }

    public function test_delete_client_works_fine()
    {
        
        $client = Client::factory()->create();
        $this->assertCount(1, Client::all());

        $this->delete("/api/clients/$client->id")
            ->assertStatus(200);

        $this->assertCount(0, Client::all());
    }
}
