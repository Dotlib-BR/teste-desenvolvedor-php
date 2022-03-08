<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    private Order $order;

    /**
     * AlineaRepository constructor.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @param array $params
     * @return Collection
     */
    public function all(array $params = []): Collection
    {
        return $this->order->newQuery()
            ->get()
            ->load('products');
    }

    /**
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function paginate(array $params = []): LengthAwarePaginator
    {
        return $this->order->newQuery()->paginate(10);
    }

    /**
     * @param array $attributes
     * @return Order
     */
    public function create(array $attributes): Order
    {
        return $this->order->create($attributes);
    }

    /**
     * @param array $attributes
     * @param mixed $id
     * @return bool
     */
    public function update(array $attributes, mixed $id): bool
    {
        $order = $this->order->newQuery()->findOrFail($id);
        return $order->update($attributes);
    }

    /**
     * @param mixed $id
     * @return bool|null
     */
    public function destroy(mixed $id): ?bool
    {
        $order = $this->order->newQuery()->findOrFail($id);
        return $order->delete();
    }

    /**
     * @param mixed $id
     * @param array $columns
     * @return Order|null
     */
    public function find(mixed $id, array $columns = ['*']): ?Order
    {
        return $this->order->newQuery()->find($id, $columns);
    }

    /**
     * @param mixed $id
     * @param array $columns
     * @return Order
     */
    public function findOrFail(mixed $id, array $columns = ['*']): Order
    {
        return $this->order->newQuery()->findOrFail($id, $columns);
    }
}
