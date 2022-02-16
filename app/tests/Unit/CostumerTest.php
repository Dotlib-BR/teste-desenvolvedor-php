<?php

namespace Tests\Unit;

use App\Models\Costumer;
use App\Models\Order;
use App\Models\User;
use Database\Factories\CostumerFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CostumerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests the relationship between a costumer and its orders.
     *
     * @return void
     */
    public function test_costumer_can_have_orders ()
    {
        $costumer = Costumer::factory()->create();
        $order = Order::factory()->for($costumer)->create();

        $this->assertEquals($costumer->id, $order->costumer->id);
    }
}
