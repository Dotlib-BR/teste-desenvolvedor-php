<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Client;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_client()
    {
        $response = $this->get(route("client.index"));

        $response->assertViewIs("client.index");
        $response->assertViewHas("clients");
        $response->assertSuccessful();
    }

    public function test_create_client()
    {
        $response = $this->get(route("client.create"));

        $response->assertViewIs("client.create");
        $response->assertSuccessful();
    }

    public function test_store_client()
    {
        $client = Client::factory()->make();
        $response = $this->post(route("client.store"), $client->toArray());

        $response->assertRedirect(route("client.index"));
        $response->assertSessionHas("success", "Cliente cadastrado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseHas('clients', $client->toArray());
    }

    public function test_edit_client()
    {
        $client = Client::factory()->create();
        $response = $this->get(route("client.edit", $client));

        $response->assertViewIs("client.edit");
        $response->assertViewHas("client", $client);
        $response->assertSuccessful();
    }

    public function test_update_client()
    {
        $client = Client::factory()->create();

        $newData = [
            "name" => "new name",
            "email" => "new@email.com",
            "cpf" => "11111111111"
        ];

        $response = $this->put(route("client.update", $client), $newData);

        $response->assertRedirect(route("client.index"));
        $response->assertSessionHas("success", "Cliente atualizado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseMissing('clients', $client->toArray());
        $this->assertDatabaseHas('clients', $newData);
    }

    public function test_delete_client()
    {
        $client = Client::factory()->create();
        $response = $this->delete(route("client.destroy", $client));

        $response->assertRedirect(route("client.index"));
        $response->assertSessionHas("success", "Cliente deletado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDeleted($client);
    }

    public function test_show_client()
    {
        $client = Client::factory()->create();
        $response = $this->get(route("client.show", $client));

        $response->assertViewIs("client.show");
        $response->assertViewHas("client", $client);
        $response->assertSuccessful();
    }
}
