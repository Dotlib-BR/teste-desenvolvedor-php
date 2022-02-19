<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render("Orders", [
            "modelPagination" => Order::with(["costumer"])
                ->when(RequestFacade::has('search'), function ($query){
                    $query->whereHas("costumer", function ($query){
                        $query->where("name", "like", "%".RequestFacade::get("search")."%")
                        ->orWhere("email", "like", "%".RequestFacade::get("search")."%");
                    });
                })
                ->paginate(20)
                ->appends(RequestFacade::except('page')),
            "filters" => ['search'=>RequestFacade::query('search','')],
            "costumers" => DB::table('costumers')->get(['id','name','email']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->index()->with([
            "modal" => [
                "active" => true,
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bought_at' => "date",
            'costumer_id' => 'required|exists:costumers,id',
        ]);

        Order::create($validated);

        return Redirect::route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return \Inertia\Response
     */
    public function show(Order $order)
    {
        return Inertia::render("Order", [
            "order" => $order->load(['costumer:id,cpf,name,email', 'products']),
            "products" => Product::get(['id','name','barcode']), // This is a BAD IDEA and I'm sorry for that, but managing API resources and authentication a TODO
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'bought_at' => "date",
        ]);

        $order->update($validated);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return $this->index();
    }
}
