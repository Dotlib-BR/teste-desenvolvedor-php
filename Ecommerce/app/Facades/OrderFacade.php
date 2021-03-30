<?php

namespace App\Facades;

use App\Services\OrderService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static store($data)
 * @method static cartStore($id)
 * @method static show($id)
 * @method static update($id, array $data)
 * @method static delete($id)
 * @method static finishItems()
 * 
*/
class OrderFacade extends Facade{

    public static function getFacadeAccessor(){
        return OrderService::class;
    }

}