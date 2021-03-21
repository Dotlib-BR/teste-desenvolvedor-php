<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Repositories\BaseRepository;

class ClienteRepository extends BaseRepository
{

    public function __construct(Cliente $cliente)
    {
        parent::__construct($cliente);
    }
}
