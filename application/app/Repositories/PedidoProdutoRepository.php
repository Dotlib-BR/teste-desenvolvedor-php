<?php

namespace App\Repositories;

use App\Contracts\Repositories\PedidoProdutoInterface;
use App\Models\PedidoProduto;
use App\Repositories\BaseRepository;

class PedidoProdutoRepository extends BaseRepository implements PedidoProdutoInterface
{

    public function __construct(PedidoProduto $pedidoProduto)
    {
        parent::__construct($pedidoProduto);
    }
}
