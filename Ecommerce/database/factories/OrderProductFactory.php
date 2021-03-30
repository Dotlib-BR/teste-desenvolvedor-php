<?php

namespace Database\Factories;

use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = $this->faker->numberBetween(0, 5);
        
        return [
            'id_order' => 1,
            'id_product' => Product::all()->random()->id,
            'quantity' => $price,
            'price' => function (array $attr) use ($price){
                return Product::find($attr['id_product'])->price * $price;
            }
        ];
    }
}
