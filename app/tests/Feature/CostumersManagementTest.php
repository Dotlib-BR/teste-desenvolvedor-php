<?php

namespace Tests\Feature;

use App\Models\Costumer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class CostumersManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_new_costumer()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        $response = $this->post('/costumers', [
            'name' => "Costumer Name",
            'email' => "mail@costumer.com",
            'cpf' => "12345678901",
        ]);

        $this->assertDatabaseHas('costumers', [
            'name' => "Costumer Name",
            'email' => "mail@costumer.com"]);
    }

    public function test_a_user_can_update_a_costumer()
    {
        $this->actingAs($user = User::factory()->create());

        $costumer = Costumer::factory()->create();

        $response = $this->patch('/costumers/' . $costumer->id, [
            'name' => "Costumer Name",
            'email' => "mail@costumer.com",
            'cpf' => "12345678901",
            ]
        );

        $this->assertSame("Costumer Name", $costumer->refresh()->name);
    }

    public function test_a_user_can_view_the_costumer_update_form()
    {
        $this->actingAs($user = User::factory()->create());

        $costumer = Costumer::factory()->create();

        $this->get('/costumers/' . $costumer->id . '/edit')
        ->assertOk();

    }

    public function test_a_user_can_delete_a_costumer()
    {
        $this->actingAs($user = User::factory()->create());

        $costumer = Costumer::factory()->create();

        $response = $this->delete('/costumers/' . $costumer->id);

        $this->assertDatabaseMissing('costumers', [
            'id' => $costumer->id,
        ]);
    }
}
