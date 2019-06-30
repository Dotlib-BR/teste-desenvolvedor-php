<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use DB;

class ProductController extends Controller
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
        $select = Product::select(['id', 'name', 'price', 'code', 'created_at', 'updated_at']);

        if ($request->has('orderby') && !empty($request->orderby)) {
            $select = $select->orderBy($request->orderby, $request->order ?? 'desc');
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = '%' . $request->search . '%';
            $select = $select->where('name', 'like', $search)
                             ->orWhere('code', 'like', $search);
        }

        $product = $select->paginate(20)->toArray();

        return view('products.index', [
            'values'     => $product['data'],
            'pagination' => [
                'current' => $product['current_page'],
                'total'   => $product['last_page']
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
        $validator = validator()->make($request->all(), [
            'name'  => 'required|string|min:4|max:100',
            'price' => 'required|numeric',
            'code'  => 'required|numeric|unique:products,code'
        ], $this->messages());

        if ($validator->passes()) {
            $product = null;

            DB::transaction(function() use($request, &$product) {
                $product = Product::create($request->except('_token'));
            });

            flashToast('success', 'Produto registrado.');
            return redirect()->route('products.show', $product->id);
        }

        flashToast('error', 'Não foi possível registrar o produto.');
        return back()->withInput()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'model' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'model' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = validator()->make($request->all(), [
            'name'  => 'required|string|min:4|max:100',
            'price' => 'required|numeric',
            'code'  => 'required|numeric|unique:products,code,' . $product->id
        ], $this->messages());

        if ($validator->passes()) {
            $data = $request->only(['name', 'price', 'code']);

            DB::transaction(function() use($product, $data) {
                $product->update($data);
            });

            flashToast('success', 'Produto atualizado.');
            return redirect()->route('products.show', $product->id);
        }

        flashToast('error', 'Não foi possível atualizar o produto.');
        return back()->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        DB::transaction(function() use($product) {
            $product->delete();
        });

        flashToast('success', 'Produto excluído.');
        return redirect()->route('products.index');
    }

    /**
     * Validation messages
     *
     * @return array
     */
    private function messages()
    {
        return [
            'name.required'   => 'Insira o nome.',
            'name.string'     => 'Nome inválido.',
            'name.min'        => 'O nome deve conter no mínimo :min caracteres.',
            'name.max'        => 'O nome deve conter no máximo :max caracteres.',
            'price.required'  => 'Insira o preço.',
            'price.numeric'   => 'Preço inválido.',
            'code.required'   => 'Insira o código de barras.',
            'code.numeric'    => 'Código de barras inválido.',
            'code.unique'     => 'Código de barras em uso.'
        ];
    }
}
