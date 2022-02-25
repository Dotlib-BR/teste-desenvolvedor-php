<?php

namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    /**
     * @param array $params
     * @return Collection
     */
    public function all(array $params = []): Collection;

    /**
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function paginate(array $params = []): LengthAwarePaginator;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param mixed $id
     * @param array $columns
     * @return Model|null
     */
    public function find(mixed $id, array $columns = ['*']): ?Model;

    /**
     * @param mixed $id
     * @param array $columns
     * @return Model
     */
    public function findOrFail(mixed $id, array $columns = ['*']): Model;

    /**
     * @param array $attributes
     * @param mixed $id
     * @return bool
     */
    public function update(array $attributes, mixed $id): bool;

    /**
     * @param mixed $id
     * @return bool|null
     */
    public function destroy(mixed $id): ?bool;
}
