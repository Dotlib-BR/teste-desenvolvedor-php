<?php

namespace App\Http\Controllers\web;

use App\Facades\ProductFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        try {
            $filterInfo = $request->only(['perPage', 'filter', 'page']);
            $filter = ProductFacade::index($filterInfo);
            $filterInfo['page'] = $filterInfo['page'] ?? 1;
            if ($filter['error'] === 0) {
                return view('user.index', ['products' => $filter['data'], 'filter' => $filterInfo]);
            }

            return redirect()->route('home')->with('error', 'Error bringing products');
        } catch (\Exception $e) {
            Log::error('PRODUCT_CONTROLLER_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Admin Product page
     * @return @return \Illuminate\Http\Response
     */
    public function indexAdmin(Request $request)
    {
        try {
            $filterInfo = $request->only(['perPage', 'filter', 'page']);
            $filter = ProductFacade::index($filterInfo);
            $filterInfo['page'] = $filterInfo['page'] ?? 1;
            if ($filter['error'] === 0) {
                return view('admin.product.index', ['products' => $filter['data'], 'filter' => $filterInfo]);
            }

            return redirect()->route('productAdmin')->with('error', 'Error bringing products');
        } catch (\Exception $e) {
            Log::error('PRODUCT_CONTROLLER_INDEX_ADMIN', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('adminHome')->with('error', 'An unexpected error has occurred');
        }
    }


    /**
     * Show product for admin
     * @param int $id
     * @return @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = ProductFacade::show($id);

            if ($product === 1) {
                return redirect()->route('productAdmin')->with('error', 'Product not found');
            }

            return view('admin.product.update', ['product' => $product['data']]);
        } catch (\Exception $e) {
            Log::error('PRODUCT_CONTROLLER_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('adminHome')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Update product action 
     * @return @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $update = ProductFacade::update($id, $data);

            if ($update['error'] == 0) {
                return back()->with('success', 'Update Successfully');
            }

            return back()->with('error', 'Error updating');
        } catch (\Exception $e) {
            Log::error('PRODUCT_CONTROLLER_INDEX_ADMIN', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('adminHome')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Add product page 
     * @return @return \Illuminate\Http\Response
     */
    public function addView()
    {
        try {
            return view('admin.product.store');
        } catch (\Exception $e) {
            Log::error('PRODUCT_CONTROLLER_ADD_VIEW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('adminHome')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Delete a many products
     * @param mixed $id Orders id
     * @return @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id = null)
    {
        try {
            $manyIds = $request->only('id');

            $deleted = ProductFacade::delete($id ?? $manyIds);
            return $deleted;
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
     * Store Action
     * @return @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $store = ProductFacade::store($data);

            if ($store['error'] === 0) {
                return redirect()->route('productAdmin');
            }

        } catch (\Exception $e) {
            Log::error('PRODUCT_CONTROLLER_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('adminHome')->with('error', 'An unexpected error has occurred');
        }
    }
}
