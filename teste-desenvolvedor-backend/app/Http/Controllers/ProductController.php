<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository
    )
    {}

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->productRepository->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        return response()->json($this->productRepository->create($request->validated()));
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
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        return response()->json($this->productRepository->update($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->productRepository->destroy($id));
    }
}
