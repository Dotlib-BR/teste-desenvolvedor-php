<?php
/**
 * Created by PhpStorm.
 * User: Vlademir Junior
 * Date: 02/07/2019
 * Time: 03:31
 */
?>

@auth
    <div id="navbarHeader">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ auth()->check() ? route('orders.index') : url('/') }}">{{ config('app.name', 'Dot.Lib') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pedidos</a>
                    </li>
                </ul>
                <div class="w-100 text-right">
                    <a class="text-decoration-none text-light fa fa-sign-out fa-2x" aria-hidden="true" href="{{ route('dashboard.user.logout') }}"></a>
                </div>
            </div>
        </nav>
    </div>
@endauth
