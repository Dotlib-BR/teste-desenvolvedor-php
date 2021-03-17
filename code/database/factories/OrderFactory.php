<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
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
            "date" => $this->faker->dateTime("now","America/Sao_Paulo"),
            "status" => $this->faker->randomElement([
                "opened",
                "paid_out",
                "canceled"
            ]),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            $products  = Product::factory(2)->create();
            $products->each(function ($product) use ($order) {
                return $order->products()->attach($product->id, [
                    "quantity" => $this->getDiscountedQuantity($product->quantity)
                ]);
            });
        });
    }

    private function getDiscountedQuantity($quantity, $percent = 0.2) {
        return $quantity * $percent;
    }
}
