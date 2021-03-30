<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\AdminFacade;

class AdminServiceProvider extends ServiceProvider
{
    public $singletons = [
        AdminFacade::class
    ];
}
