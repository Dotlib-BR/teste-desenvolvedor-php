<?php

namespace App\Repositories;

use App\Models\Pedido;
use App\Repositories\BaseRepository;

class PedidoRepository extends BaseRepository
{

    public function __construct(Pedido $pedido)
    {
        parent::__construct($pedido);
    }
}
