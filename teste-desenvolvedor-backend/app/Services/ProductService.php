<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductService
{
    /**
     * ProductService constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository,
    )
    {}

    /**
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function destroy(int $id): bool
    {
        /** @var Product $product */
        $product = $this->productRepository->findOrFail($id);

        return DB::transaction(function () use ($product) {

            $product->orders()->detach();

            return $this->productRepository->destroy($product->id);
        });
    }

}
