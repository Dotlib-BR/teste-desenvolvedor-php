<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $select = Order::select(['id', 'status', 'discount', 'created_at', 'updated_at']);

        if ($request->has('orderby') && !empty($request->orderby)) {
            $select = $select->orderBy($request->orderby, $request->order ?? 'asc');
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = '%' . $request->search . '%';
            $select = $select->where('status', 'like', $search)
                             ->orWhere('id', 'like', $search)
                             ->orWhereHas('productsDirectly', function($query) use($search) {
                                 $query->where('name', 'like', $search);
                             });
        }

        $items = $request->items ?? 20;
        $order = $select->paginate($items);

        return view('orders.index', [
            'items'      => $order->items(),
            'pagination' => [
                'current' => $order->currentPage(),
                'total'   => $order->lastPage()
            ]
        ]);
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
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', [
            'order'     => $order,
            'products'  => Product::all()
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
        //
    }

    /**
     * Validation messages
     *
     * @return array
     */
    private function messages()
    {
        return [
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
