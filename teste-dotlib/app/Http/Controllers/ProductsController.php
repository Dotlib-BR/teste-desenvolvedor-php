<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository){ $this->productsRepository = $productsRepository; }

    public function index($filter) {
        $products = DB::table('products')
                        ->orderBy($filter, 'desc')
                        ->simplePaginate(20);
        return view('products', [
            'products' => $products
        ]);
    }

    public function store(Request $request) {
        $product = $request->validate([
            'unit_value' => 'required',
            'bar_code' => 'required',
        ], [
            'unit_value.required' => 'O valor do produto é obrigatório',
            'bar_code.required' => 'O código de barras do produto é obrigatório',
        ]);

        $this->productsRepository->store($request);

        return redirect()->route('products', 'id');
    }

    public function updateAjax(Request $request) {
        $this->productsRepository->updateProductByIdAjax($request);
    }

    public function showAjax($id) {
        return $this->productsRepository->getProductByIdAjax($id);
    }

    public function destroyAjax($id) {
       $this->productsRepository->destroyProductByIdAjax($id);
    }

}
