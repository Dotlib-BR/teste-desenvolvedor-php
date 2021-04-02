<?php

namespace App\Facades;

use App\Services\OrderService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static store(array $data)
 * @method static cartStore(\Illuminate\Http\Request $request)
 * @method static show(int $id)
 * @method static update(int $id, array $data)
 * @method static delete(mixed $id)
 * @method static index(array $filter)
 * @method static finishItems()
 * 
*/
class OrderFacade extends Facade{

    public static function getFacadeAccessor(){
        return OrderService::class;
    }

}