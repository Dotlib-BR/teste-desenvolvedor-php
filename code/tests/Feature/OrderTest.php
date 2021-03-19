<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_order()
    {
        $response = $this->get(route("order.index"));

        $response->assertViewIs("order.index");
        $response->assertViewHas("orders");
        $response->assertSuccessful();
    }

    public function test_create_order()
    {
        $response = $this->get(route("order.create"));

        $response->assertViewIs("order.create");
        $response->assertViewHas("products", Product::all());
        $response->assertSuccessful();
    }
    public function test_store_order()
    {
        $order = Order::factory()->make();
        $products = Product::factory(2)->create();

        $productsIds = $products->map(fn($product) => $product->id)->toArray();
        $productsQuantity = $products->map(fn($product) => $product->quantity * 0.2)->toArray();

        $productData = [
            "products" => $productsIds,
            "quantities" => $productsQuantity
        ];
        $data = array_merge($order->toArray(), $productData);

        $response = $this->post(route("order.store"), $data);

        $response->assertRedirect(route("order.index"));
        $response->assertSessionHas("success", "Pedido cadastrado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseHas('orders', $order->toArray());
    }

    public function test_edit_order()
    {
        $order = Order::factory()->create();
        $response = $this->get(route("order.edit", $order));

        $response->assertViewIs("order.edit");
        $response->assertViewHas("order", $order);
        $response->assertViewHas("allProducts", Product::all());
        $response->assertSuccessful();
    }

    public function test_update_order()
    {
        $order = Order::factory()->create();
        $products = Product::factory(2)->create();

        $productsIds = $products->map(fn($product) => $product->id)->toArray();
        $productsQuantity = $products->map(fn($product) => $product->quantity * 0.2)->toArray();

        $productData = [
            "products" => $productsIds,
            "quantities" => $productsQuantity
        ];
        $orderData = ["status" => $order->status == "opened" ? "canceled" : "opened", "date" => $order->date];
        $data = array_merge($orderData, $productData);

        $response = $this->put(route("order.update", $order), $data);

        $response->assertRedirect(route("order.index"));
        $response->assertSessionHas("success", "Pedido atualizado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseMissing('orders', $order->toArray());
    }

    public function test_delete_order()
    {
        $order = Order::factory()->create();
        $response = $this->delete(route("order.destroy", $order));

        $response->assertRedirect(route("order.index"));
        $response->assertSessionHas("success", "Pedido deletado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDeleted($order);
    }

    public function test_show_order()
    {
        $order = Order::factory()->create();
        $response = $this->get(route("order.show", $order));

        $response->assertViewIs("order.show");
        $response->assertViewHas("order", $order);
        $response->assertSuccessful();
    }
}
