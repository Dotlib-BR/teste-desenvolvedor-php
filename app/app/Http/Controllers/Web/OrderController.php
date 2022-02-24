<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
            'per_page' => 'integer',
            'search_params',
        ]);


        if(session('success_message')) {
            Alert::success('Sucesso!', session('success_message'));
        }

        $per_page = $request->input('per_page') ?: 20;
        $search_params = $request->input('search_params');

        if ($search_params) {
            $orders = Order::advancedSearch($search_params)->paginate($per_page);
        } else {
            $orders = Order::paginate($per_page);
        }

        return view('orders.index', [
            'orders' => $orders->appends(request()->input()),
            'per_page' => $per_page,
            'searchable' => true,
            'search_params' => $search_params
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $order = Order::create($validatedData);
        return redirect(route('orders.edit', ['order' => $order]))->withSuccessMessage('Pedido criado com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $discounts = Discount::all();
        return view('orders.edit', compact('order', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'numeric',
            'discount_id' => 'numeric|nullable'
        ]);

        Order::findOrFail($id)->update($validatedData);
        return redirect(route('orders.index'))->withSuccessMessage('Pedido editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect(route('orders.index'))->withSuccessMessage('Pedido apagado com sucesso');
    }
}
