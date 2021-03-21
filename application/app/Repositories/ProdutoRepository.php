<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Repositories\BaseRepository;

class ProdutoRepository extends BaseRepository
{

    public function __construct(Produto $produto)
    {
        parent::__construct($produto);
    }
}
