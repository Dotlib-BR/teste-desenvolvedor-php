<?php

namespace Tests\Unit;

use App\Models\Costumer;
use App\Models\User;
use Database\Factories\CostumerFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests the relationship between a user and a costumer.
     *
     * @return void
     */
    public function test_user_can_have_costumers ()
    {
        $user = User::factory()->create();
        $costumer = Costumer::factory()->for($user)->create();

        $this->assertEquals($user->id, $costumer->user_id);
    }

}
