<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
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
            $products = Product::advancedSearch($search_params)->paginate($per_page);
        } else {
            $products = Product::paginate($per_page);
        }

        return view('products.index', [
            'products' => $products->appends(request()->input()),
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
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'barcode' => 'required|string'
        ]);

        Product::create($validatedData);
        return redirect(route('products.index'))->withSuccessMessate('Produto criado com sucess');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
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
            'name' => 'string',
            'price' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'barcode' => 'numeric',
        ]);

        Product::findOrFail($id)->update($validatedData);

        return redirect(route('products.index'))->withSuccessMessage('Produto editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect(route('products.index'))->withSuccessMessage('Produto removido');
    }
}
