<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\ProductFacade;

class ProductServiceProvider extends ServiceProvider
{
    public $singletons = [
        ProductFacade::class
    ];
}
