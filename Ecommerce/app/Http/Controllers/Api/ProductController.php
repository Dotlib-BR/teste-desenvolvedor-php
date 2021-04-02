<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Facades\ProductFacade;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductStoreRequest;
use App\Http\Requests\Api\ProductUpdateRequest;

class ProductController extends Controller
{

    /** 
     * List Users
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $filterInfo = $request->only(['perPage', 'filter', 'page']);
            $products = ProductFacade::index($filterInfo);

            if (!empty($products['data']->onEachSide)) {
                $products['data'] = $products['data']->items();
            }

            if ($products['error'] === 0) {
                return response([
                    'error' => 0,
                    'data' => $products['data']
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Error bringing products.'
            ]);
        } catch (\Exception $e) {
            Log::error('PRODUCT_API_CONTROLLER_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred'
            ]);
        }
    }

    /**
     * Get product
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $product = ProductFacade::show($id);

            if ($product['error'] === 0) {
                return response([
                    'error' => 0,
                    'data' => $product['data']
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Product not found.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('PRODUCT_API_CONTROLLER_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred'
            ]);
        }
    }

    /**
     * Store a new product
     * @param \App\Http\Requests\Api\ProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        try {
            $data = $request->all();

            $store = ProductFacade::store($data);

            if ($store['error'] === 0) {
                return response([
                    'error' => 0,
                    'description' => 'Product successfully registered.'
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Error registering product.'
            ]);
        } catch (\Exception $e) {
            Log::error('PRODUCT_API_CONTROLLER_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }

    /**
     * Delete a many products
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id = null)
    {
        try {
            $manyIds = $request->only('id');

            $deleted = ProductFacade::delete($id ?? $manyIds);

            if ($deleted['error'] === 0) {
                return [
                    'error' => 0,
                    'message' => 'success'
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error when trying delete a product.'
            ];
        } catch (\Exception $e) {
            Log::error('PRODUCT_CONTROLLER_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error when trying delete a product.'
            ];
        }
    }

    /**
     * Update specific product
     * @param \App\Http\Requests\Api\ProductUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, int $id)
    {
        try {
            $data = $request->all();

            $store = ProductFacade::update($id, $data);

            if ($store['error'] === 0) {
                return response([
                    'error' => 0,
                    'description' => 'Product updated successfully.'
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Error updating product'
            ]);
        } catch (\Exception $e) {
            Log::error('PRODUCT_API_CONTROLLER_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }
}
