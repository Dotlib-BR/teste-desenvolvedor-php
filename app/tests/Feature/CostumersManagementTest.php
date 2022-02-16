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

    public function test_an_user_can_create_a_new_costumer()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->post('/costumers', [
            'name' => "Costumer Name",
            'email' => "mail@costumer.com",
            'cpf' => "12345678901",
        ]);

        $this->assertTrue($user->refresh()->costumers->contains('name', 'Costumer Name'));
    }

    public function test_an_user_cannot_magane_costumers_belonging_to_another_user()
    {
        $this->actingAs($user = User::factory()->create());

        $user2 = User::factory()->create();

        $response = $this->post('/costumers', [
            'name' => "Costumer Name",
            'email' => "mail@costumer.com",
            'cpf' => "12345678901",
            'user_id' => $user2->id,
        ]);

        $this->assertFalse($user2->refresh()->costumers->contains('name', 'Costumer Name'));
    }

    public function test_an_user_can_update_own_costumer()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $costumer = Costumer::factory()->for($user)->create();

        $response = $this->patch('/costumers/' . $costumer->id, [
            'name' => "Costumer Name",
            'email' => "mail@costumer.com",
            'cpf' => "12345678901",
            ]
        );

        $this->assertSame("Costumer Name", $costumer->refresh()->name);
    }

    public function test_an_user_can_delete_own_costumer()
    {
        $this->actingAs($user = User::factory()->create());

        $costumer = Costumer::factory()->for($user)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->delete('/costumers/' . $costumer->id);

        $this->assertDatabaseMissing('costumers', [
            'id' => $costumer->id,
        ]);
    }
}
