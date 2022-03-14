<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class UserService
{
    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param ClientRepositoryInterface $clientRepository
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private ClientRepositoryInterface $clientRepository,
        private OrderService $orderService,
        private OrderRepositoryInterface $orderRepository
    ) {

    }

    /**
     * @param array $attributes
     * @return User
     * @throws Throwable
     */
    public function create(array $attributes): User
    {
        $attributes['verification_token'] = hash('sha256', Str::random(60));

        return DB::transaction(function () use ($attributes) {
            $client = $this->clientRepository->create([
                'name' => $attributes['name'],
                'cpf' => $attributes['cpf'],
            ]);

            $clientId = $this->clientRepository->findOrFail($client->id)->id;

            $attributes = array_merge($attributes, ['client_id' => $clientId]);
            return $this->userRepository->create($attributes);
        });
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function update(array $attributes, int $id): bool
    {
        return DB::transaction(function () use ($attributes, $id) {

            $this->clientRepository->update([
                'name' => $attributes['name'],
                'cpf' => $attributes['cpf'],
            ], $id);

            return $this->userRepository->update($attributes, $id);

        });
    }

    /**
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function destroy(int $id): bool
    {
        return DB::transaction(function () use ($id) {

            /** @var Client $client */
            $user = $this->userRepository->findOrFail($id);
            $client = $this->clientRepository->findOrFail($user->client_id);
            $this->orderRepository->destroyByClient($client->id);
            return $this->clientRepository->destroy($client->id);
        });
    }
}
