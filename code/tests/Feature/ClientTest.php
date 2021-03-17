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
        $response = $this->get('/client');

        $response->assertViewIs("client.index");
        $response->assertViewHas("clients");
        $response->assertSuccessful();
    }

    public function test_create_client()
    {
        $response = $this->get('/client/create');

        $response->assertViewIs("client.create");
        $response->assertSuccessful();
    }

    public function test_store_client()
    {
        $client = Client::factory()->make();
        $response = $this->post('/client', $client->toArray());

        $response->assertViewIs("client.index");
        $response->assertViewHas("clients");
        $response->assertSee($client);
        $response->assertSee("Cliente salvo");
        $response->assertSuccessful();
    }

    public function test_edit_client()
    {
        $client = Client::factory()->create();
        $response = $this->get("/client/edit/{$client}");

        $response->assertViewIs("client.edit");
        $response->assertViewHas("client", $client);
        $response->assertSuccessful();
    }

    public function test_update_client()
    {
        $client = Client::factory()->create();

        $newName = "Novo Nome";
        $clientOldName = $client->name;

        $client->name = $newName;
        $response = $this->put("/client/{$client}", $client->toArray());

        $response->assertViewIs("client.index");
        $response->assertViewHas("clients");
        $response->assertSee($client);
        $response->assertSee("Cliente atualizado");
        $response->assertSee($newName);
        $response->assertDontSee($clientOldName);
        $response->assertSuccessful();
    }

    public function test_delete_client()
    {
        $client = Client::factory()->create();
        $response = $this->delete("/client/{$client}");

        $response->assertViewIs("client.index");
        $response->assertViewHas("clients");
        $response->assertDontSee($client);
        $response->assertSee("Cliente deletado");
        $response->assertSuccessful();
    }
}
