<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\User;
use DB;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create', [
            'users'     => User::all(),
            'products'  => Product::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'user_id'           => 'required|exists:users,id',
            'product'           => 'required|array',
            'product.*.id'      => 'required|exists:products,id',
            'product.*.amount'  => 'required|integer',
            'discount'          => 'required|numeric'
        ], $this->messages());

        if ($validator->passes()) {
            $order = null;

            DB::transaction(function() use($request, &$order) {
                $order = Order::create([
                    'user_id'  => $request->user_id,
                    'discount' => $request->discount,
                    'status'   => $request->status
                ]);

                $products = [];

                foreach ($request->product as $product) {
                    $products[] = new OrderProduct([
                        'product_id' => $product['id'],
                        'amount'     => $product['amount']
                    ]);
                }

                $order->products()->saveMany($products);
            });

            if ($order) {
                flashToast('success', 'Pedido criado.');
                return redirect()->route('orders.show', $order->id);
            }
        }

        flashToast('error', 'Não foi possível criar o pedido.');
        return back()->withInput()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit', [
            'order'     => $order,
            'users'     => User::all(),
            'products'  => Product::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validator = validator()->make($request->all(), [
            'user_id'           => 'required|exists:users,id',
            'product'           => 'required|array',
            'product.*.id'      => 'required|exists:products,id',
            'product.*.amount'  => 'required|integer',
            'discount'          => 'required|numeric'
        ], $this->messages());

        if ($validator->passes()) {
            DB::transaction(function() use($order, $request) {
                $order->discount = $request->discount;
                $order->status   = $request->status;
                $order->save();

                $products = [];

                foreach ($request->product as $product) {
                    $products[] = new OrderProduct([
                        'product_id' => $product['id'],
                        'amount'     => $product['amount']
                    ]);
                }

                $order->products()->delete();
                $order->products()->saveMany($products);
            });

            flashToast('success', 'Pedido atualizado.');
            return redirect()->route('orders.show', $order->id);
        }

        flashToast('error', 'Não foi possível atualizar o pedido.');
        return back()->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        DB::transaction(function() use($order) {
            $order->delete();
        });

        flashToast('success', 'Pedido excluído.');
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'id' => 'required|array',
        ], $this->messages());

        if ($validator->passes()) {
            DB::transaction(function() use($request) {
                Order::whereIn('id', $request->id)->delete();
            });

            flashToast('success', 'Pedidos excluídos.');
            return redirect()->route('orders.index');
        }

        flashToast('error', 'Não foi possível excluir os pedidos selecionados.');
        return back();
    }

    /**
     * Validation messages
     *
     * @return array
     */
    private function messages()
    {
        return [
            'id.required'           => 'Selecione os pedidos.',
            'id.array'              => 'Pedidos inválidos.',
            'user_id.required'      => 'Selecione o comprador.',
            'user_id.exists'        => 'O comprador não foi encontrado.',
            'product.required'      => 'É necessário ter ao menos um produto no pedido.',
            'product.array'         => 'Produtos inválidos.',
            'product.*.id.required' => 'Selecione o produto.',
            'product.*.id.exists'   => 'O produto não foi encontrado.',
            'product.*.amount'      => 'Insira a quantidade.',
            'discount.required'     => 'Insira o desconto.',
            'discount.numeric'      => 'Desconto inválido.'
        ];
    }
}
