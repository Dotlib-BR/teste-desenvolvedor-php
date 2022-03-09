<?php

namespace App\Services;

use App\Models\{ Order, Product, Customer};
use DateTime;

class OrderService {
    /**
     * Create order in Database
     *
     * @param DateTime $date
     * @param Customer $customer
     * @param Product $product
     * @return Order
     */
    public function createOrder(DateTime $date, Customer $customer, Product $product): Order
    {
        $order = new Order();
        $order->date = $date->format('Y-m-d');
        $order->id_customer = $customer->id;
        $order->id_product = $product->id;
        $order->save();

        return $order;
    }

    /**
     * Get order from database from id
     *
     * @param int $id
     * @return Order|null
     */
    public function getOrderById(int $id): Order|null
    {
        $order = Order::with(['product', 'customer'])->find($id);

        return $order;
    }

    /**
     * Get orders by database, filters as params
     *
     * @param int $per_page
     * @param int $page
     * @param string $searchTerm
     * @param string $orderBy
     * @param string $orderDirection
     * @return Order[]
     */
    public function getOrders(int $per_page = 20, int $page = 0, string $searchTerm = '', string $orderBy = 'id', string $orderDirection = 'ASC'): array {
        $orders = Order::
            orderBy($orderBy, $orderDirection)
            ->with(['product', 'customer'])
            ->whereHas('customer', function ($query) use ($searchTerm) {
                $query
                    ->where('customers.name', 'ILIKE', '%' . $searchTerm . '%')
                    ->orWhere('customers.cpf', 'ILIKE', '%' . $searchTerm . '%');
            })->orWhereHas('product', function ($query) use ($searchTerm) {
                $query
                    ->where('products.name', 'ILIKE', '%' . $searchTerm . '%')
                    ->orWhere('products.code', 'ILIKE', '%' . $searchTerm . '%');
            })
            ->skip($per_page * $page)
            ->take($per_page)
            ->get();

        return $orders->all();
    }

    /**
     * Update Order in Database
     *
     * @param Order $order
     * @param DatetTime $date
     * @param Customer $customer
     * @param Product $product
     * @return Order
     * @return
     */
    public function updateOrder(Order $order, DateTime $date, Customer $customer, Product $product): Order
    {
        $order->date = $date->format('Y-m-d');
        $order->id_customer = $customer->id;
        $order->id_product = $product->id;
        $order->save();

        return $order;
    }

    /**
     * Delete Order in Database
     *
     * @param int $id
     */
    public function deleteOrderById(int $id)
    {
        Order::where('id', $id)->delete();
    }

    /**
     * Get orders count from database, params to filter
     *
     * @param string $searchTerm
     * @return int
     */
    public function getOrdersCount(string $searchTerm = ''): int
    {
        return Order::whereHas('customer', function ($query) use ($searchTerm) {
                $query
                    ->where('customers.name', 'ILIKE', '%' . $searchTerm . '%')
                    ->orWhere('customers.cpf', 'ILIKE', '%' . $searchTerm . '%');
            })->orWhereHas('product', function ($query) use ($searchTerm) {
                $query
                    ->where('products.name', 'ILIKE', '%' . $searchTerm . '%')
                    ->orWhere('products.code', 'ILIKE', '%' . $searchTerm . '%');
            })->count();
    }
}
