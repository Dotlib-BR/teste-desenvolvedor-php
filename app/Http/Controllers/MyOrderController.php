<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $orders = Auth()->user()->orders; // n + 1 issues
        
        $orders = Auth()->user()->orders()->with('products')->paginate(20); // fix n + 1 issues
        
        return view('orders.details', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     *  Filters of my order (details) view. Search with date and option per page.
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $query = $request->input('query');

        $myOrders = Order::query();

        if ($request->has('query')) {
            $myOrders->where('product', 'LIKE', "%$query%");
        }

        if ($request->has('check_date')) {
            $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if ($start > $end) {
                return back()->withErrors('A data inicial não pode ser maior que a data final.');
            }

            $myOrders->whereBetween('created_at', [$start, $end]);
        }
        if ($request->has('order_by')) {
            $myOrders->orderBy('product', $request->input('order_by'));
        }

        if ($request->has('perPage')) {
            $myOrderQuery = $myOrders->paginate($request->input('perPage'));
        } else {
            $myOrderQuery = $myOrders->paginate(20);
        }

        return view('orders.details')->with([
            'myOrderResults' => $myOrderQuery,
        ]);
    }
}
