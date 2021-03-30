<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new AdminRepository();
    }
}