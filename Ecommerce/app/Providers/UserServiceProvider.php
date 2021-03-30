<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\UserFacade;

class UserServiceProvider extends ServiceProvider
{
    public $singletons = [
        UserFacade::class
    ];
}
