<?php

namespace App\Providers;

use App\Contracts\Repositories\ClienteInterface;
use App\Contracts\Repositories\CupomDescontoInterface;
use App\Contracts\Repositories\PedidoInterface;
use App\Contracts\Repositories\PedidoProdutoInterface;
use App\Contracts\Repositories\ProdutoInterface;
use App\Contracts\Repositories\StatusPedidoInterface;
use App\Contracts\Repositories\UserInterface;
use App\Repositories\ClienteRepository;
use App\Repositories\CupomDescontoRepository;
use App\Repositories\PedidoProdutoRepository;
use App\Repositories\PedidoRepository;
use App\Repositories\ProdutoRepository;
use App\Repositories\StatusPedidoRepository;
use App\Repositories\UserRepository;
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
        app()->bind(ClienteInterface::class, ClienteRepository::class);
        app()->bind(CupomDescontoInterface::class, CupomDescontoRepository::class);
        app()->bind(PedidoInterface::class, PedidoRepository::class);
        app()->bind(PedidoProdutoInterface::class, PedidoProdutoRepository::class);
        app()->bind(StatusPedidoInterface::class, StatusPedidoRepository::class);
        app()->bind(UserInterface::class, UserRepository::class);
        app()->bind(ProdutoInterface::class, ProdutoRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
