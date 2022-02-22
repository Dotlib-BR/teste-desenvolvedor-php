<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Services\OrderService;
use Database\Seeders\OrderSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'required|integer',
        ]);
        
        return Order::paginate($request->input('per_page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|integer|exists:App\Models\Client,id',
            'products' => 'required|array',
            'products.*.id' => 'required|integer|exists:App\Models\Product,id',
            'products.*.quantity' => 'required|integer',
        ]);

        return OrderService::create($request->input('client_id'), $request->input('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Order::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Order not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return Order::findOrFail($id)->delete();
        } catch(ModelNotFoundException $e) {
            return response(['message' => 'Order not founded'], 404);
        }
    }
}
