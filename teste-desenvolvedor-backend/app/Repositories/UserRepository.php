<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    private User $user;

    /**
     * AlineaRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $params
     * @return Collection
     */
    public function all(array $params = []): Collection
    {
        return $this->user->newQuery()->get();
    }

    /**
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function paginate(array $params = []): LengthAwarePaginator
    {
        return $this->user->newQuery()->paginate(10);
    }

    /**
     * @param array $attributes
     * @return User
     */
    public function create(array $attributes): User
    {
        return $this->user->create($attributes);
    }

    /**
     * @param array $attributes
     * @param mixed $id
     * @return bool
     */
    public function update(array $attributes, mixed $id): bool
    {
        $user = $this->user->newQuery()->findOrFail($id);
        return $user->update($attributes);
    }

    /**
     * @param mixed $id
     * @return bool|null
     */
    public function destroy(mixed $id): ?bool
    {
        $user = $this->user->newQuery()->findOrFail($id);
        return $user->delete();
    }

    public function find(mixed $id, array $columns = ['*']): ?User
    {
        return $this->user->newQuery()->find($id, $columns);
    }

    public function findOrFail(mixed $id, array $columns = ['*']): User
    {
        return $this->user->newQuery()->findOrFail($id, $columns);
    }
}
