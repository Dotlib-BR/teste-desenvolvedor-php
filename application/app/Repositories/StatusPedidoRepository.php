<?php

namespace App\Repositories;

use App\Models\StatusPedido;
use App\Repositories\BaseRepository;

class StatusPedidoRepository extends BaseRepository
{

    public function __construct(StatusPedido $statusPedido)
    {
        parent::__construct($statusPedido);
    }
}
