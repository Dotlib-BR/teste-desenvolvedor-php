<?php

namespace App\Repositories;

use App\Contracts\Repositories\StatusPedidoInterface;
use App\Models\StatusPedido;
use App\Repositories\BaseRepository;

class StatusPedidoRepository extends BaseRepository implements StatusPedidoInterface
{

    public function __construct(StatusPedido $statusPedido)
    {
        parent::__construct($statusPedido);
    }
}
