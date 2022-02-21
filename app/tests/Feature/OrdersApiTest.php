<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrdersApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_route_require_per_page_parameter()
    {
        $this->get('/api/orders')
            ->assertSessionHasErrors('per_page');
    }

    public function test_index_route_returns_paginated_items()
    {
        Order::factory()
            ->count(20)    
            ->create();
        $response = $this->get('/api/orders?per_page=15')
            ->decodeResponseJson();
        
        $orders = $response['data'];
        $this->assertCount(15, $orders);
    }

    public function test_show_route_requires_a_valid_order_id()
    {
        $this->get('/api/orders/123343')
            ->assertStatus(404)
            ->assertJson(['message' => 'Order not found']);
    }

    public function test_show_route_get_the_specific_order()
    {
        $order = Order::factory()->create();
        $response = $this->get("/api/orders/$order->id")
            ->assertStatus(200)
            ->decodeResponseJson();
        $this->assertEquals($order->id, $response['id']);
    }

    public function test_store_route_require_valid_client_id()
    {
        $product = Product::factory()->create();

        $this->post("/api/orders", [
            'client_id' => 23144231,
            'products' => [
                [
                    'id' => $product->id,
                    'quantity' => 1,
                ]
            ]
        ])->assertSessionHasErrors('client_id');
    }

    public function test_store_route_require_valid_product_data()
    {
        $client = Client::factory()->create();
        
        $this->post('/api/orders', [
            'client_id' => $client->id,
            'products' => [
                [
                    'id' => 1234,
                    'quantity'=> 1
                ]
            ]
        ])->assertSessionHasErrors('products.0.id');
    }

    public function test_store_route_works_with_valid_product_data()
    {
        $product = Product::factory()->create();
        $client = Client::factory()->create();

        $this->post('/api/orders', [
            'client_id' => $client->id,
            'products' => [
                [
                    'id' => $product->id,
                    'quantity' => 1
                ]
            ]
        ])->assertSessionHasNoErrors()
        ->assertStatus(200);
    }

    public function test_store_route_creates_both_order_and_order_product_items()
    {
        $this->assertEquals(0, Order::count());
        $this->assertEquals(0, OrderProduct::count());
        $product = Product::factory()->create();
        $client = Client::factory()->create();

        $this->post('/api/orders', [
            'client_id' => $client->id,
            'products' => [
                [
                    'id' => $product->id,
                    'quantity' => 1
                ]
            ]
        ]);

        $this->assertEquals(1, Order::count());
        $this->assertEquals(1, OrderProduct::count());

        $this->post('/api/orders',[
            'client_id' => $client->id,
            'products' => [
                [
                    'id' => $product->id,
                    'quantity' => 1
                ]
            ]
        ]);

        $this->assertEquals(2, Order::count());
        $this->assertEquals(2, OrderProduct::count());
    }

    public function test_destroy_route_need_a_valid_order_id()
    {
        $this->delete('/api/orders/1')
            ->assertStatus(404)
            ->assertJson(['message' => 'Order not founded']);
    }
    
    public function test_destroy_route_works_fine()
    {
        $order = Order::factory()->hasOrderProducts(1)->create();

        $this->delete("/api/orders/$order->id")
            ->assertStatus(200);

        $this->assertEmpty(Order::all());
        $this->assertEmpty(OrderProduct::all());
    }
}
