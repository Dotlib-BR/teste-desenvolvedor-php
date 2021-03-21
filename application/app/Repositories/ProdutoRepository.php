<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProdutoInterface;
use App\Models\Produto;
use App\Repositories\BaseRepository;

class ProdutoRepository extends BaseRepository implements ProdutoInterface
{

    public function __construct(Produto $produto)
    {
        parent::__construct($produto);
    }
}
