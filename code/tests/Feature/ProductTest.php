<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_product()
    {
        $response = $this->get(route("product.index"));

        $response->assertViewIs("product.index");
        $response->assertViewHas("products");
        $response->assertSuccessful();
    }

    public function test_create_product()
    {
        $response = $this->get(route("product.create"));

        $response->assertViewIs("product.create");
        $response->assertSuccessful();
    }

    public function test_store_product()
    {
        $product = Product::factory()->make();
        $response = $this->post(route("product.store"), $product->toArray());

        $response->assertRedirect(route("product.index"));
        $response->assertSessionHas("success", "Produto cadastrado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }

    public function test_edit_product()
    {
        $product = Product::factory()->create();
        $response = $this->get(route("product.edit", $product));

        $response->assertViewIs("product.edit");
        $response->assertViewHas("product", $product);
        $response->assertSuccessful();
    }

    public function test_update_product()
    {
        $product = Product::factory()->create();

        $newData = [
            "name" => "new name",
            "email" => "new@email.com",
            "cpf" => "11111111111"
        ];

        $response = $this->put(route("product.update", $product), $newData);

        $response->assertRedirect(route("product.index"));
        $response->assertSessionHas("success", "Produto atualizado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }

    public function test_delete_product()
    {
        $product = Product::factory()->create();
        $response = $this->delete(route("product.destroy", $product));

        $response->assertRedirect(route("product.index"));
        $response->assertSessionHas("success", "Produto deletado!");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }

    public function test_show_product()
    {
        $product = Product::factory()->create();
        $response = $this->get(route("product.show", $product));

        $response->assertViewIs("product.show");
        $response->assertViewHas("product", $product);
        $response->assertSuccessful();
    }
}
