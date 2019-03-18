<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App\Cliente;
use App\Produto;

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
        //
        Schema::defaultStringLength(191);

        Validator::extend('nao_vazio', function($attr, $value, $params) {
            if (empty($value)) return false;
            return true;
        }, 'O :attribute não pode ser vazio');

        Validator::extend('cliente_existe', function($attr, $value, $params) {
            if(Cliente::find($value) === null) return false;
            return true;
        }, 'O cliente não existe');

        Validator::extend('produto_existe', function($attr, $value, $params) {
            if(Produto::find($value) === null) return false;
            return true;
        }, 'O produto não existe');
    }
}
