<?php

namespace App\Repositories;

use App\Models\CupomDesconto;
use App\Repositories\BaseRepository;

class CupomDescontoRepository extends BaseRepository
{

    public function __construct(CupomDesconto $cupomDesconto)
    {
        parent::__construct($cupomDesconto);
    }
}
