<?php

namespace App\Facades;

use App\Services\AdminService;
use Illuminate\Support\Facades\Facade;

class AdminFacade extends Facade{

    public static function getFacadeAccessor(){
        return AdminService::class;
    }

}