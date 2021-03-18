<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Order::paginate(20);

        return view('orders.show-all', compact('pedidos'));
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
     *  Function to ajax call and remove checked ids.
     *  
     *  @return \Illuminate\Http\Response
     */
    public function removeLot(Request $request)
    {
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        $ids = $request->ids;
        Order::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Compra removida.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->addToPedidosTables($request, null);

        session()->forget('cupom');

        return back()->with('success_message', 'Obrigado pela compra!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $findProduct = Product::find($id);
        
        $sub = $findProduct->price;
        $discount = session()->get('cupom')['discount'] ?? 0;
        $newSubtotal = ($sub - $discount);

        return view('orders.buy', compact('findProduct', 'newSubtotal'));
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

    public function excluir($id)
    {
        $orderDestroy = Order::find($id);

        if($orderDestroy){
            $orderDestroy->delete();

            return redirect()->route('orders.index')->with('success_message', 'Compra deletada.');
        }else{
            abort(404);
        }
    }

    protected function addToPedidosTables($request)
    {
        $sub = $request->cost;

        //insert into pedidos table
        $pedidos = Order::create([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'product' => $request->product_name,
            'qty' => $request->qty,
            'CPF' => auth()->user()->CPF,
            'discount' => session()->get('cupom')['discount'] ?? 0,
            'cost' => $sub,
            'status' => 'Aguardando processamento',
            'user_id' => auth()->user() ? auth()->user()->id : null,
        ]);

        //insert into order_products table
        OrderProduct::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'pedido_id' => $pedidos->id,
            'produto_id' => $request->product_id,
        ]);

        return $pedidos;
    }

    /**
     *  Filters of order view. Search with date and option per page.
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $query = $request->input('query');

        $orderResults = Order::query();

        if ($request->has('query')) {
            $orderResults->where('name', 'LIKE', "%$query%");
        }

        if ($request->has('check_date')) {
            $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if ($start > $end) {
                return back()->withErrors('A data inicial não pode ser maior que a data final.');
            }

            $orderResults->whereBetween('created_at', [$start, $end]);
        }
        if ($request->has('order_by')) {
            $orderResults->orderBy('name', $request->input('order_by'));
        }

        if ($request->has('perPage')) {
            $orderQuery = $orderResults->paginate($request->input('perPage'));
        } else {
            $orderQuery = $orderResults->paginate(20);
        }

        return view('orders.show-all')->with([
            'orderResults' => $orderQuery,
        ]);
    }
}
