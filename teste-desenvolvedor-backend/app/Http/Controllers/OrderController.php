<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Redirect;

class OrderController extends Controller
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private ProductRepositoryInterface $productRepository,
        private OrderService $orderService
    )
    {}

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $orders = $this->orderRepository->paginate();
        return view('orders.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return View
     */
    public function create(): view
    {
        $products = $this->productRepository->all();
        return view('orders.crud', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();
        $this->orderService->create($request->toArray(), $user);

        return redirect()->route('pedidos.index');
    }

//    /**
//     * Display the specified resource.
//     *
//     */
//    public function show(int $id)
//    {
//        $order = $this->orderRepository->findOrFail($id);
//        return json_encode([$order]);
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param Order $order
     * @return View
     */
    public function edit(Order $order): view
    {
        return view('orders.crud', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     * @param int $id
     * @return View
     */
    public function update(UpdateOrderRequest $request, int $id): view
    {
        $this->orderRepository->update($request->validated(), $id);

        return view('orders.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy(Order $order): JsonResponse
    {
        return response()->json($this->orderRepository->destroy($order));
    }

    /**
     * @param Request $request
     * @return View
     */
    public function search(Request $request): View
    {
        $orders = $this->orderRepository->search($request->input('search'));

        return view('orders.index', compact('orders'));
    }
}
