<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.paginate', 'paginate');
        // Contém o paginate do bootstrap

        Blade::component('components.session', 'session');
        // Contém alertas com sessões para mostrar o usuário.
    }
}
