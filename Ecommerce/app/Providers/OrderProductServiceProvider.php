<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OrderProductServiceProvider extends ServiceProvider
{
    public $singletons = [
        OrderProductFacade::class
    ];
}
