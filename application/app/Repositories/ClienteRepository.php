<?php

namespace App\Repositories;

use App\Contracts\Repositories\ClienteInterface;
use App\Models\Cliente;
use App\Repositories\BaseRepository;

class ClienteRepository extends BaseRepository implements ClienteInterface
{

    public function __construct(Cliente $cliente)
    {
        parent::__construct($cliente);
    }
}
