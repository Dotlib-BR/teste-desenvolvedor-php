<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(20);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        return view('products.create');
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
            'product' => 'required',
            'bar_code' => 'required|unique:products',
            'price' => 'required',
        ]);

        if(Auth::user()->role_id != 1){
            abort(404);
        }

        Product::create($request->all());

        return redirect()->route('product.index')->with('success_message', 'Produto cadastrado com sucesso.');
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
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        $findProduct = Product::find($id);

        return view('products.create', compact('findProduct'));
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
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        $request->validate([
            'product' => 'required',
            'bar_code' => 'required|unique:products',
            'price' => 'required',
        ]);

        $updateProduct = Product::find($id);
        if($updateProduct){
            $updateProduct->update($request->all());

            return redirect()->route('product.index')->with('success_message', 'Produto atualizado com sucesso.');
        }else{
            abort(404);
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
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        $destroyProduct = Product::find($id);

        if($destroyProduct){
            $destroyProduct->delete();

            return redirect()->route('product.index')->with('success_message', 'Produto removido com sucesso.');
        }else{
            abort(404);
        }
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
        Product::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Usuário removido.']);
    }

    /**
     *  Filters of product view. Search with date and option per page.
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $query = $request->input('query');

        $productsResults = Product::query();

        if ($request->has('query')) {
            $productsResults->where('product', 'LIKE', "%$query%");
        }

        if ($request->has('check_date')) {
            $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if ($start > $end) {
                return back()->withErrors('A data inicial não pode ser maior que a data final.');
            }

            $productsResults->whereBetween('created_at', [$start, $end]);
        }
        if ($request->has('order_by')){
            $productsResults->orderBy('product', $request->input('order_by'));
        }

        if ($request->has('perPage')){
            $productQuery = $productsResults->paginate($request->input('perPage'));
        }else{
            $productQuery = $productsResults->paginate(20);
        }

        return view('products.index')->with([
            'productsResults' => $productQuery,
        ]);
    }
}
