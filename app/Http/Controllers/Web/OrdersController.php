<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Services\{CustomerService, OrderService, ProductService};
use DateTime;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OrderService $orderService)
    {
        $per_page = (int) $request->get('per_page', 20);
        $page = (int) $request->get('page', 0);
        $search_term = (string) $request->get('search_term', '');
        list($order_by, $order_direction) = explode('|', (string) $request->get('order_by', 'id|asc'));

        $orders = $orderService->getOrders($per_page, $page, $search_term, $order_by, $order_direction);

        return view('orders', [
            'orders' => $orders,
            'per_page' => $per_page,
            'search_term' => $search_term,
            'order_by' => join('|', [$order_by, $order_direction]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CustomerService $customerService, ProductService $productService)
    {
        $customersCount = $customerService->getCustomersCount();
        $productsCount = $productService->getProductsCount();

        $customers = $customerService->getCustomers(per_page: $customersCount);
        $products = $productService->getProducts(per_page: $productsCount);

        return view('order_create', [
            'customers' => $customers,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request, OrderService $orderService, ProductService $productService, CustomerService $customerService)
    {
        $request->validated();

        $product = $productService->getProductById($request->id_product);
        $customer = $customerService->getCustomerById($request->id_customer);
        $date = new DateTime($request->date);
        $orderService->createOrder($date, $customer, $product);

        return redirect()->route('orders');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id, OrderService $orderService, ProductService $productService, CustomerService $customerService)
    {
        $order = $orderService->getOrderById((int) $id);

        if (!$order) {
            return redirect()->route('orders');
        }

        $customersCount = $customerService->getCustomersCount();
        $productsCount = $productService->getProductsCount();

        $customers = $customerService->getCustomers(per_page: $customersCount);
        $products = $productService->getProducts(per_page: $productsCount);

        return view('order_edit', [
            'customers' => $customers,
            'products' => $products,
            'id' => $order->id,
            'id_product' => $order->id_product,
            'id_customer' => $order->id_customer,
            'date' => $order->date,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(string $id, OrderRequest $request, OrderService $orderService, ProductService $productService, CustomerService $customerService)
    {
        $request->validated();

        $order = $orderService->getOrderById((int) $id);

        if (!$order) {
            return redirect()->route('orders');
        }

        $product = $productService->getProductById($request->id_product);
        $customer = $customerService->getCustomerById($request->id_customer);
        $date = new DateTime($request->date);
        $orderService->updateOrder($order, $date, $customer, $product);

        return redirect()->route('orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id, OrderService $orderService)
    {
        $orderService->deleteOrderById((int) $id);

        return redirect()->route('orders');
    }
}
