<?php

namespace App\Repositories;

use App\Contracts\Repositories\PedidoInterface;
use App\Models\Pedido;
use App\Repositories\BaseRepository;

class PedidoRepository extends BaseRepository implements PedidoInterface
{

    public function __construct(Pedido $pedido)
    {
        parent::__construct($pedido);
    }
}
