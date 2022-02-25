<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ClientRepository implements ClientRepositoryInterface
{
    private Client $client;

    /**
     * ClientRepository constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $params
     * @return Collection
     */
    public function all(array $params = []): Collection
    {
        return $this->client->newQuery()->get();
    }

    /**
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function paginate(array $params = []): LengthAwarePaginator
    {
        return $this->client->newQuery()->paginate(10);
    }

    /**
     * @param array $attributes
     * @return Client
     */
    public function create(array $attributes): Client
    {
        return $this->client->create($attributes);
    }

    /**
     * @param array $attributes
     * @param mixed $id
     * @return bool
     */
    public function update(array $attributes, mixed $id): bool
    {
        $client = $this->client->newQuery()->findOrFail($id);
        return $client->update($attributes);
    }

    /**
     * @param mixed $id
     * @return bool|null
     */
    public function destroy(mixed $id): ?bool
    {
        $client = $this->client->newQuery()->findOrFail($id);
        return $client->delete();
    }

    /**
     * @param mixed $id
     * @param array $columns
     * @return Model|null
     */
    public function find(mixed $id, array $columns = ['*']): ?Client
    {
        return $this->client->newQuery()->findOrFail($id, $columns);
    }

    public function findOrFail(mixed $id, array $columns = ['*']): Client
    {
        return $this->client->newQuery()->findOrFail($id, $columns);
    }
}
