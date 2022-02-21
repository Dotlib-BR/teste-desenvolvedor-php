<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Services\OrderService;
use Exception;

class OrderCreationTest extends TestCase
{
    use RefreshDatabase;

    private array $products;
    private Client $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = Client::factory()->create();
        $products = Product::factory()->count(2)->create()->toArray();

        $this->products = [
            [
                'id' => $products[0]['id'],
                'quantity' => 2,
            ],
            [
                'id' => $products[1]['id'],
                'quantity' => 1,
            ]
        ];
    }

    public function test_order_products_items_are_created_on_order_creations()
    {
        OrderService::create($this->client->id, $this->products);

        $this->assertCount(1, Order::all());
        $this->assertEquals($this->client->id, Order::first()->client_id);

        $this->assertCount(2, OrderProduct::all());
        $this->assertEquals(2, OrderProduct::first()->quantity);
        $this->assertEquals(1, OrderProduct::all()[1]->quantity);
    }

    /**
     * A basic feature test example.
     *
     * @group yoo
     * @return void
     */
    public function test_if_failed_to_create_order_product_main_order_is_not_created()
    {
        $this->expectException(Exception::class);
        OrderService::create($this->client->id, [$this->products]);
        
        $this->assertEmpty(Order::all());
    }
}
