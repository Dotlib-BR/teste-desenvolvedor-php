<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\OrderFacade;

class OrderServiceProvider extends ServiceProvider
{
    public $singletons = [
        OrderFacade::class
    ];
}
