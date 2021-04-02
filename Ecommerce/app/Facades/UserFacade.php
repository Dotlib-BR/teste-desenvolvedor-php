<?php

namespace App\Facades;

use App\Services\UserService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static store(array $data)
 * @method static show(int $id)
 * @method static update(int $id, array $data)
 * @method static delete(array $id)
 * @method static index(array $data)
*/
class UserFacade extends Facade{

    public static function getFacadeAccessor(){
        return UserService::class;
    }

}