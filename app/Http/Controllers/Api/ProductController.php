<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
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

        return $this->successResponse([
            'products' => ProductResource::collection($products),
            'meta' => [
                'per_page' => $per_page,
                'page' => $page,
                'last_page' => ceil($productsCount / $per_page),
                'search_term' => $search_term,
                'order_by' => join('|', [$order_by, $order_direction]),
            ]
        ]);
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

        $product = $productService->createProduct($request->code, $request->name, $request->warehouse_quantity, $request->value);

        return $this->successResponse(new ProductResource($product), 'Product Created', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id, ProductService $productService)
    {
        $product = $productService->getProductById((int) $id);

        if (!$product) {
            return $this->errorResponse('Product not found', Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse(new ProductResource($product));
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
            return $this->errorResponse('Product not found', Response::HTTP_NOT_FOUND);
        }

        $productService->updateProduct($product, $request->code, $request->name, $request->warehouse_quantity, $request->value);

        return $this->successResponse(new ProductResource($product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id, ProductService $productService)
    {
        $productService->deleteProductById((int) $id);

        return $this->successResponse(null, 'Successfully deleted', Response::HTTP_NO_CONTENT);
    }
}
