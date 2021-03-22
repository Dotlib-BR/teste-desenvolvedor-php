<?php

namespace App\Services;

use App\Contracts\Repositories\ClienteInterface;

class BaseService
{
    protected $repository;

    public function __construct(object $interface)
    {
        $this->repository = $interface;
    }

    public function get($ids = null)
    {
        return $this->repository->get($ids);
    }

    public function update(int $id, array $input)
    {
        return $this->repository->update($id, $input);
    }

    public function delete($id) {
        return $this->repository->delete($id);
    }

    public function where($where, $value)
    {
        return $this->repository->where($where, $value);
    }
    public function findColumn($where, $value)
    {
        return $this->repository->where($where, $value)->first();
    }
}
