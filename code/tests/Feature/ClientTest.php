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
}
