<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminRepository implements AdminRepositoryInterface
{

    private $model;

    public function __construct()
    {
        $this->model = new Admin();
    }

}