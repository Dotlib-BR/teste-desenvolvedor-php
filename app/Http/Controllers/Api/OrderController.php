<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Services\{CustomerService, OrderService, ProductService};
use DateTime;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
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
        $ordersCount = $orderService->getOrdersCount($search_term);

        return $this->successResponse([
            'orders' => OrderResource::collection($orders),
            'meta' => [
                'per_page' => $per_page,
                'page' => $page,
                'last_page' => ceil($ordersCount / $per_page),
                'search_term' => $search_term,
                'order_by' => join('|', [$order_by, $order_direction]),
            ]
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
        $order = $orderService->createOrder($date, $customer, $product);

        return $this->successResponse(new OrderResource($order));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id, OrderService $orderService)
    {
        $order = $orderService->getOrderById((int) $id);

        if (!$order) {
            return $this->errorResponse('Order not found', Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse(new OrderResource($order));
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
            return $this->errorResponse('Order not found', Response::HTTP_NOT_FOUND);
        }

        $product = $productService->getProductById($request->id_product);
        $customer = $customerService->getCustomerById($request->id_customer);
        $date = new DateTime($request->date);
        $orderService->updateOrder($order, $date, $customer, $product);
        $order = $orderService->getOrderById($order->id); // get again to update relations

        return $this->successResponse(new OrderResource($order));
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

        return $this->successResponse(null, 'Successfully deleted', Response::HTTP_NO_CONTENT);
    }
}
