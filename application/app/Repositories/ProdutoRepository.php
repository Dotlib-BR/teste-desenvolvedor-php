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

    public function getAtivos(?array $ids = null)
    {
        if ($ids !== null || is_array($ids)) {
            return $this->model->where('ativo', 1)->whereIn('id', $ids)->get();
        }
        return $this->model->where('ativo', 1)->get();
    }

    public function paginate($pag = 20)
    {
        return $this->model->filter()->paginate($pag);
    }
}
