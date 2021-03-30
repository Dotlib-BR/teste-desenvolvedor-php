<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderProduct;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'n_order' => '#' . $this->faker->numerify('########'),
            'id_user' => User::all()->random()->id,
            'total_price' => function(){
                $price_product = Product::all()->random()->price;
                return $price_product * $this->faker->numberBetween(0, 5);
            },
            'status' => '0',
            'dt_order' => now()
        ];
    }
}
