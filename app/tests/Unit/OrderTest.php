<?php

namespace Tests\Unit;

use App\Models\Costumer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Database\Factories\CostumerFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests an order can have products.
     *
     * @return void
     */
    public function test_order_can_have_products ()
    {
        $order = Order::factory()->create();

        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();

        $order->products()->attach($product1, ['quantity' => 1]);
        $order->products()->attach($product2, ['quantity' => 2]);

        $this->assertCount(2, $order->products);
    }
}
