<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    private Product $product;

    /**
     * ProductRepository constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param array $params
     * @return Collection
     */
    public function all(array $params = []): Collection
    {
        return $this->product->newQuery()->get();
    }

    /**
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function paginate(array $params = []): LengthAwarePaginator
    {
        return $this->product->newQuery()->paginate(10);
    }

    /**
     * @param array $attributes
     * @return Product
     */
    public function create(array $attributes): Product
    {
        return $this->product->create($attributes);
    }

    /**
     * @param array $attributes
     * @param mixed $id
     * @return bool
     */
    public function update(array $attributes, mixed $id): bool
    {
        $product = $this->product->newQuery()->findOrFail($id);
        return $product->update($attributes);
    }

    /**
     * @param mixed $id
     * @return bool|null
     */
    public function destroy(mixed $id): ?bool
    {
        $product = $this->product->newQuery()->findOrFail($id);
        return $product->delete();
    }

    public function find(mixed $id, array $columns = ['*']): ?Product
    {
        return $this->product->newQuery()->find($id, $columns);
    }

    public function findOrFail(mixed $id, array $columns = ['*']): Product
    {
        return $this->product->newQuery()->findOrFail($id, $columns);
    }
}
