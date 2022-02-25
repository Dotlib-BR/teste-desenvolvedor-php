<?php

namespace App\Services;

use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientService
{
    /**
     * ClientService constructor.
     * @param ClientRepositoryInterface $clientRepository
     */
    public function __construct(
        private ClientRepositoryInterface $clientRepository
    ) {

    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id): bool
    {
        return $this->clientRepository->update($attributes, $id);
    }


}
