<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_route_require_per_page()
    {
        $this->get('/api/products')
            ->assertSessionHasErrors(['per_page']);
    }

    public function test_index_route_return_paginated_data()
    {
        Product::factory()->count(20)->create();

        $response = $this->get('/api/products?per_page=15');
        $content = $response->decodeResponseJson();
        $this->assertCount(15, $content['data']);
        $this->assertEquals(20, $content['total']);
    }

    public function test_show_route_require_a_existing_product_id()
    {
        $this->get('/api/products/1')
            ->assertStatus(404)
            ->assertJson(['message' => 'Product not found']);
    }

    public function test_show_route_works_fine()
    {
        $product = Product::factory()->create();
        $content = $this->get("/api/products/$product->id")
            ->assertStatus(200)
            ->decodeResponseJson();
        $this->assertEquals($product->id, $content['id']);
    }

    public function test_store_route_validate_request_data()
    {
        $this->post('/api/products', [])
            ->assertSessionHasErrors(['name', 'price', 'barcode']);
    }

    public function test_store_route_checks_for_name_and_barcode_already_in_use()
    {
        Product::factory(['name' => 'yoo', 'barcode' => '1234'])->create();
        $this->post('/api/products', [
            'name' => 'yoo',
            'price' => 120.12,
            'barcode' => 1234
        ])->assertSessionHasErrors(['name', 'barcode']);
    }

    public function test_store_route_works_fine()
    {
        $this->assertCount(0, Product::all());
        $this->post('/api/products', [
            'name' => 'yoo',
            'price' => 32.42,
            'barcode' => 1342512354,
        ]);

        $this->assertCount(1, Product::all());
        $this->assertEquals('yoo', Product::first()->name);
    }

    public function test_update_route_checks_for_name_and_barcodes_already_in_use()
    {
        $product = Product::factory()->create();
        $this->put('/api/products/1', [
            'name' => $product->name,
            'barcode' => $product->barcode,
        ])->assertSessionHasErrors(['name', 'barcode']);
    }

    public function test_update_route_require_a_existing_product_id()
    {
        $response = $this->put('/api/products/2341', [
            'name' => 'yoo',
            'price' => 3241.32,
            'barcode' => 324412,
        ])->assertStatus(404)
        ->decodeResponseJson();

        $this->assertEquals('Product not found', $response['message']);
    }

    public function test_update_route_works_fine()
    {
        $product = Product::factory()->create();
        $this->put("/api/products/$product->id", [
            'name' => 'yoo',
        ]);
        $this->assertEquals('yoo', Product::first()->name);
    }

    /**
     * @group yoo
     */
    public function test_delete_route_need_a_valid_id_or_throw_message()
    {
        $this->delete('/api/products/1432')
            ->assertStatus(404)
            ->assertJson(['message' => 'Product not found']);
    }

    public function test_delete_route_works_fine()
    {
        $product = Product::factory()->create();
        $this->assertCount(1, Product::all());

        $this->delete("/api/products/$product->id")
            ->assertStatus(200)
            ->assertJson(['message' => 'Product successfully deleted']) ;
    }
}
