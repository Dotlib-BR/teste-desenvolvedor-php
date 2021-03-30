<?php

namespace App\Facades;

use App\Services\UserService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static store($data)
 * @method static show($id)
 * @method static update($id, array $data)
 * @method static delete($id)
*/
class UserFacade extends Facade{

    public static function getFacadeAccessor(){
        return UserService::class;
    }

}