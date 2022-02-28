<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class OrderService
{
    /**
     * OrderService constructor.
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private ProductRepositoryInterface $productRepository
    )
    {}

    /**
     * @param array $attributes
     * @param User $user
     * @return mixed
     */
    public function create(array $attributes, User $user): Order
    {
        $clientId = $user->client()->first()->id;

        //$product = $this->productRepository->findOrFail($attributes['product_id']);

        $totalPrice = 0;
        foreach ($attributes['products'] as $products) {

            $product = $this->productRepository->findOrFail($products['product_id']);

            $priceOfProduct = $product->price;

            $quantity = $products['quantity'];
            $totalPrice = $priceOfProduct * $quantity;

            //array of products prices
            $prices[] = $priceOfProduct;
            $AllPrices[] = $totalPrice;
        }

        $sumAllPrices = array_sum($AllPrices);

        $order = $this->orderRepository->create([
            'client_id' => $clientId,
            'total_price' => $sumAllPrices,
        ]);

        $i = 0;
        foreach ($attributes['products'] as $products) {

            $product = $this->productRepository->findOrFail($products['product_id']);

            $quantity = $products['quantity'];

            $order->products()->attach($product->id, [
                'quantity' => $quantity,
                'price' => $prices[$i],
            ]);

            $i++;
        }

        return $order->load('products');
    }

}
