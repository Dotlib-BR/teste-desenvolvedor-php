<?php

namespace App\Http\Controllers\web;

use App\Facades\ProductFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $pages = $request->page ?? 10;
        $products = ProductFacade::index($pages);
        return view('user.product.index', ['products' => $products]);
    }

    public function show($id)
    {
    }

    /**
     * Return edit screen of admin for update Product 
     * @return view Edit Screen
     */
    public function editView($id)
    {
        $product = ProductFacade::show($id);

        if ($product === 1) {
            return redirect('/Produtos')->with('fail', 'Produto não encontrado');
        }

        return view('admin.product.update', ['product' => $product['data']]);
    }

    /**
     * Update product action 
     * @return redirect Products or back to the edit screen
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $update = ProductFacade::update($id, $data);

        if ($update['error'] == 0) {
            return redirect()->route('adminHome')->with('success', 'Mudança feita com sucesso sucesso!');
        }

        return back()->with('error', 'Este nome de produto já existe');
    }


    public function registerView()
    {
        return view('admin.product.store');
    }

    /**
     * Delete a many products
     * @param mixed $id Orders id
     */
    public function delete(Request $request, $id = null){
        $manyIds = $request->only('id');

        $deleted = ProductFacade::delete($id ?? $manyIds);
        return $deleted;
        if($deleted['error'] === 0) {
            return [
                'error' => 0,
                'message' => 'success'
            ];
        }

        return [
            'error' => 1,
            'description' => 'Error when trying delete a product.'
        ];
    }

    public function store(ProductStoreRequest $request) {

        $data = $request->validated();
        $store = ProductFacade::store($data);

        if($store['error'] === 0) {
            return redirect()->route('adminHome');
        }
    }
}
