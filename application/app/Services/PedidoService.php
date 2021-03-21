<?php

namespace App\Services;

use App\Contracts\Repositories\PedidoInterface;

class PedidoService
{

    protected $pedidoRepository;

    public function __construct(PedidoInterface $pedidoRepository)
    {
        $this->pedidoRepository = $pedidoRepository;
    }

    public function novoNumeroPedido($id)
    {
        $numero = $this->formataNumero($id);

        return $numero;
    }

    private function formataNumero($num)
    {
        return str_pad($num, 8, '0', STR_PAD_LEFT);
    }
}
