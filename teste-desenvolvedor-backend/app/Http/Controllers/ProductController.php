<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class ProductController extends Controller
{
    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ProductService $productService
    )
    {}

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $products = $this->productRepository->paginate();
        return view('products.index', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return View
     */
    public function create(): View
    {
        return view('products.crud');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $this->productRepository->create($request->validated());
        return redirect()->route('produtos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->productRepository->findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $product = $this->productRepository->findOrFail($id);
        return view('products.crud', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, int $id): RedirectResponse
    {
        $this->productRepository->update($request->validated(), $id);
        return redirect()->route('produtos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->productService->destroy($id);

        return redirect()->route('produtos.index');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function search(Request $request): View
    {
        $products = $this->productRepository->search($request->input('search'));

        return view('products.index', compact('products'));
    }
}
