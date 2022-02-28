<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserRepository implements UserRepositoryInterface
{
    private User $user;

    /**
     * UserRepository constructor.
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
        $attributes['password'] = Hash::make($attributes['password']);
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

    /**
     * @param string $email
     * @return Model|null
     */
    public function findByEmail (string $email) : ?User
    {
        return $this->user->newQuery()
            ->where('email', strtolower($email))
            ->first();
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
