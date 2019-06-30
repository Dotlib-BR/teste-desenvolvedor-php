<?php

namespace App\Providers;

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
        view()->composer('*', function($view) {
            $name = explode('.', $view->getName());

            if (count($name) > 1) {
                $names = [
                    'users'    => ['Usuário', 'Usuários'],
                    'products' => ['Produto', 'Produtos'],
                    'orders'   => ['Pedido', 'Pedidos']
                ];

                view()->share('route', $name[0]);

                if (array_key_exists($name[0], $names)) {
                    view()->share('singular', $names[$name[0]][0]);
                    view()->share('plural', $names[$name[0]][1]);
                } else {
                    view()->share('singular', 'unknown');
                    view()->share('plural', 'unknown');
                }
            } else {
                view()->share('route', 'unknown');
            }
        });

        validator()->extend('cpf', function($attribute, $value, $parameters, $validator) {
            $cpf = preg_replace( '/[^0-9]/is', '', $value);

            if (strlen($cpf) != 11) {
                return false;
            }

            if (preg_match('/(\d)\1{10}/', $cpf)) {
                return false;
            }

            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        });
    }
}
