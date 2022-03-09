<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProductService $productService)
    {
        $per_page = (int) $request->get('per_page', 20);
        $page = (int) $request->get('page', 0);
        $search_term = (string) $request->get('search_term', '');
        list($order_by, $order_direction) = explode('|', (string) $request->get('order_by', 'id|asc'));

        $products = $productService->getProducts($per_page, $page, $search_term, $order_by, $order_direction);
        $productsCount = $productService->getProductsCount($search_term);

        return view('products', [
            'products' => $products,
            'per_page' => $per_page,
            'page' => $page,
            'last_page' => ceil($productsCount / $per_page),
            'search_term' => $search_term,
            'order_by' => join('|', [$order_by, $order_direction]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ProductService $productService)
    {
        $request->validated();

        $productService->createProduct($request->code, $request->name, $request->warehouse_quantity, $request->value);

        return redirect()->route('products');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id, ProductService $productService)
    {
        $product = $productService->getProductById((int) $id);

        if (!$product) {
            return redirect()->route('products');
        }

        return view('product_edit', [
            'id' => $product->id,
            'code' => $product->code,
            'name' => $product->name,
            'warehouse_quantity' => $product->warehouse_quantity,
            'value' => $product->value,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, string $id, ProductService $productService)
    {
        $request->validated();

        $product = $productService->getProductById((int) $id);

        if (!$product) {
            return redirect()->route('products');
        }

        $productService->updateProduct($product, $request->code, $request->name, $request->warehouse_quantity, $request->value);

        return redirect()->route('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ProductService $productService)
    {
        $productService->deleteProductById((int) $id);

        return redirect()->route('products');
    }
}
