<?php

namespace Tests\Feature;

use App\Models\Costumer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class ProductsManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_product()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/products', [
                'name' => 'Product 1',
                'price' => '10.00',
                'barcode' => "barcode",
            ]);

        $this->assertDatabaseHas('products',
            ["name" => "Product 1"]);
    }

    public function test_a_user_can_manage_products()
    {
        $product = Product::factory()->create();

        $this->actingAs($product->user)
            ->patch('/products/'.$product->id, [
                'name' => 'Product 1',
                'price' => '10.00',
                'barcode' => "barcode",
                'id' => $product->id,
            ]);

        $this->assertDatabaseHas('products',[
            'name' => 'Product 1',
            'price' => '10.00',
            'barcode' => "barcode",
        ]);
    }
}
