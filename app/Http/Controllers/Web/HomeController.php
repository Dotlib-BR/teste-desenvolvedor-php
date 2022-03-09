<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\{CustomerService, OrderService, ProductService};

class HomeController extends Controller
{
    /**
     * Show homepage
     */
    public function __invoke(OrderService $orderService, CustomerService $customerService, ProductService $productService)
    {
        $ordersCount = $orderService->getOrdersCount();
        $customersCount = $customerService->getCustomersCount();
        $productsCount = $productService->getProductsCount();

        return view('welcome', [
            'orders_count' => $ordersCount,
            'customers_count' => $customersCount,
            'products_count' => $productsCount,
        ]);
    }
}
