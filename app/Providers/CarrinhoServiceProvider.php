<?php

namespace App\Providers;

use App\Carrinho;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CarrinhoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function register()
    {
        //
        $this->app->bind('carrinho',function(){
            return new  \App\Carrinho\Carrinho;
        });
    }

}
