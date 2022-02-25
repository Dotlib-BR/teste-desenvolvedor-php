<?php

namespace App\Providers;

use App\Repositories\Interfaces\{
    ClientRepositoryInterface,
    UserRepositoryInterface,
    OrderRepositoryInterface,
    ProductRepositoryInterface,
};
use App\Repositories\{
    ClientRepository,
    UserRepository,
    OrderRepository,
    ProductRepository,
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ClientRepositoryInterface::class,
            ClientRepository::class,
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class,
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class,
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
