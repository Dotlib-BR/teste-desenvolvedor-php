<?php

namespace App\Repositories;

use App\Contracts\Repositories\CupomDescontoInterface;
use App\Models\CupomDesconto;
use App\Repositories\BaseRepository;

class CupomDescontoRepository extends BaseRepository implements CupomDescontoInterface
{

    public function __construct(CupomDesconto $cupomDesconto)
    {
        parent::__construct($cupomDesconto);
    }
}
