<?php

namespace App\Providers;

use App\Models\Purchase;
use App\Observers\PurchaseObserver;
use Illuminate\Support\ServiceProvider;

class PurchaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Observer
        Purchase::observe(PurchaseObserver::class);
    }
}
