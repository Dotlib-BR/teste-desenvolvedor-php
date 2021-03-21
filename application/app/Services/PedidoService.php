<?php

namespace App\Services;

use App\Repositories\PedidoRepository;

class PedidoService
{

    protected $pedidoRepository;

    public function __construct(PedidoRepository $pedidoRepository)
    {
        $this->pedidoRepository = $pedidoRepository;
    }

    public function novoNumeroPedido($id)
    {
        return str_pad($id, 5, '0', STR_PAD_LEFT);
    }
}
