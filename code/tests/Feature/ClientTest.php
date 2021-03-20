<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Client;
use App\Models\User;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_client()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("client.index"));

        $response->assertViewIs("client.index");
        $response->assertViewHas("clients");
        $response->assertSuccessful();
    }

    public function test_create_client()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("client.create"));

        $response->assertViewIs("client.create");
        $response->assertSuccessful();
    }

    public function test_store_client()
    {
        $client = Client::factory()->make();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route("client.store"), $client->toArray());

        $response->assertRedirect(route("client.index"));
        $response->assertSessionHas("success", "Cliente cadastrado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseHas('clients', $client->toArray());
    }

    public function test_edit_client()
    {
        $client = Client::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("client.edit", $client));

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

        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route("client.update", $client), $newData);

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
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route("client.destroy", $client));

        $response->assertRedirect(route("client.index"));
        $response->assertSessionHas("success", "Cliente deletado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDeleted($client);
    }

    public function test_show_client()
    {
        $client = Client::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("client.show", $client));

        $response->assertViewIs("client.show");
        $response->assertViewHas("client", $client);
        $response->assertSuccessful();
    }

    public function test_mult_delete_client()
    {
        Client::factory(5)->create();
        $clients = Client::take(5);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route("client.multDestroy"), ["clients_id" => $clients->pluck("id")->toArray()]);

        $response->assertRedirect(route("client.index"));
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas("success", "Clientes deletados!");
        $response->assertStatus(302);
        $this->assertDeleted($clients);
    }

}
