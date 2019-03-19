<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Client;
use App\Product;

use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::orderBy('id','DESC')->paginate(200);
        return view('order.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::pluck('name', 'id');
        return view('order.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isset($request['products'])) {
             return redirect()
        	->route('orders.create')
            ->with('danger','Nenhum produto selecionado!');
        }
        $this->validate($request, [
            'order_date' => 'required',
            'status' => 'required',
            'client' => 'required',
        ]);

        $input = $request->all();
        $order = Order::create($input);
        $order->number = "10".$order->id;
        
        foreach ($request->input('products') as $key => $value) {

            if(!$order->products()->whereId($value)->exists()) {
                $order->products()->attach($value);

                DB::table('order_product')
                ->where('order_id', $order->id)
                ->where('product_id', $value)
                ->update(['qtd_order' => $request['qtt_prod_'.$value]]);
            }   
        }

        $order->client_id = $request['client'];
        $order->save();
        
        return redirect()
        	->route('orders.index')
            ->with('success','Pedido inserido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $products = $order->products;
        $qtt = [];

        foreach ($products as $product => $value) {
            
            $qtt[$value->id] = DB::table('order_product')
                ->where('order_id', $order->id)
                ->where('product_id', $value->id)
                ->get();
        }

        return view('order.show', compact('order', 'products', 'qtt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = Client::pluck('name', 'id');
        $order = Order::find($id);
        $client = $order->client_id;
        $products = $order->products;
        $qtt = [];

        foreach ($products as $product => $value) {
            
            $qtt[$value->id] = DB::table('order_product')
                ->where('order_id', $order->id)
                ->where('product_id', $value->id)
                ->get();
        }

        return view('order.edit', compact('order', 'products', 'qtt', 'clients', 'client'));
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
        $this->validate($request, [
            'order_date' => 'required',
            'status' => 'required',
            'client' => 'required',
        ]);

        $order = Order::find($id);
        $order->order_date = $request['order_date'];
        $order->status = $request['status'];
        $order->client_id = $request['client'];
        $order->save();
        
        if(isset($request['products'])) {
            foreach ($request->input('products') as $key => $value) {

                if(!$order->products()->whereId($value)->exists()) {
                    $order->products()->attach($value);

                    DB::table('order_product')
                        ->where('order_id', $order->id)
                        ->where('product_id', $value)
                        ->update(['qtd_order' => $request['qtt_product_'.$value]]);
                }   
            }
        }

        return redirect()
            ->route('orders.index')
            ->with('success','Pedido atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delete();
    	return back()->with('success','Produto excluído com sucesso!');
    }

    public function updateQtt(Request $r) {
        
        $order = Order::find($r['order_id']);

        DB::table('order_product')
        ->where('order_id', $order->id)
        ->where('product_id', $r['product_id'])
        ->update(['qtd_order' => $r['qtt']]);

        return back()->with('success','Cliente excluído com sucesso!');
    }

    public function deleteProd($orderId, $productId) {

        DB::table('order_product')
        ->where('order_id', $orderId)
        ->where('product_id', $productId)
        ->delete();

        return back();
    }
}
