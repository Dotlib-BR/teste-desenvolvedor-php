<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use function GuzzleHttp\Promise\all;

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

        $quantity = [];
        foreach ($attributes['quantity'] as $key => $value){
            if ($value > 0){
                $quantity[] = $value;
            }
        }

        $subtotal = 0;
        $totalPrice = 0;
        $i=0;
        foreach ($attributes['checkbox'] as $products) {

            $product = $this->productRepository->findOrFail($products+1);

            $priceOfProduct = $product->price;

            $subtotal = $priceOfProduct * $quantity[$i];

            //array of products prices
            $prices[] = $priceOfProduct;
            $totalPrice = $subtotal + $totalPrice;
            $i++;
        }

        $order = $this->orderRepository->create([
            'client_id' => $clientId,
            'total_price' => $totalPrice,
        ]);

        $i = 0;
        foreach ($attributes['checkbox'] as $products) {

            $product = $this->productRepository->findOrFail($products+1);

            $priceOfProduct = $product->price;

            $totalPrice = $priceOfProduct * (int)$quantity;

            $order->products()->attach($product->id, [
                'quantity' => $quantity[$i],
                'price' => $totalPrice,
            ]);

            $i++;
        }

        return $order->load('products');
    }

}
