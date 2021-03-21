<?php

namespace App\Repositories;

use App\Models\PedidoProduto;
use App\Repositories\BaseRepository;

class PedidoProdutoRepository extends BaseRepository
{

    public function __construct(PedidoProduto $pedidoProduto)
    {
        parent::__construct($pedidoProduto);
    }
}
