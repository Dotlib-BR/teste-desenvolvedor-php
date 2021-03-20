<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_product()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("product.index"));

        $response->assertViewIs("product.index");
        $response->assertViewHas("products");
        $response->assertSuccessful();
    }

    public function test_create_product()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("product.create"));

        $response->assertViewIs("product.create");
        $response->assertSuccessful();
    }

    public function test_store_product()
    {
        $product = Product::factory()->make();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route("product.store"), $product->toArray());

        $response->assertRedirect(route("product.index"));
        $response->assertSessionHas("success", "Produto cadastrado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseHas('products', $product->toArray());
    }

    public function test_edit_product()
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("product.edit", $product));

        $response->assertViewIs("product.edit");
        $response->assertViewHas("product", $product);
        $response->assertSuccessful();
    }

    public function test_update_product()
    {
        $product = Product::factory()->create();

        $newData = [
            "name" => "new name",
            "quantity" => 150,
            "price" => 14.99,
            "bar_code" => "1111111111111111111"
        ];

        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route("product.update", $product), $newData);

        $response->assertRedirect(route("product.index"));
        $response->assertSessionHas("success", "Produto atualizado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseMissing('products', $product->toArray());
        $this->assertDatabaseHas('products', $newData);
    }

    public function test_delete_product()
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route("product.destroy", $product));

        $response->assertRedirect(route("product.index"));
        $response->assertSessionHas("success", "Produto deletado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDeleted($product);
    }

    public function test_show_product()
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("product.show", $product));

        $response->assertViewIs("product.show");
        $response->assertViewHas("product", $product);
        $response->assertSuccessful();
    }

    public function test_mult_delete_product()
    {
        Product::factory(5)->create();
        $products = Product::take(5);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route("product.multDestroy"), ["products_id" => $products->pluck("id")->toArray()]);

        $response->assertRedirect(route("product.index"));
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas("success", "Produtos deletados!");
        $response->assertStatus(302);
        $this->assertDeleted($products);
    }
}
