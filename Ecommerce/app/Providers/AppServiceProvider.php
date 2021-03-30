<?php

namespace App\Providers;

use App\Models\OrderProduct;
use App\Observers\OrderProductObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        OrderProduct::observe(OrderProductObserver::class);
    }
}
