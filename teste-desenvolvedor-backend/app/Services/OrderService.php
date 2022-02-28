<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderService
{
    /**
     * OrderService constructor.
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
    )
    {}

    /**
     * @param array $attributes
     * @param User $user
     * @return mixed
     */
    public function create(array $attributes, User $user): Order

    {
        $quantity = $attributes['quantity'];

        $product = $this->orderRepository->findOrFail($attributes['product_id']);

        $priceOfProduct = $product->price;

        $totalPrice = $priceOfProduct * $quantity;

        return $this->orderRepository->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
        ]);

    }

}
