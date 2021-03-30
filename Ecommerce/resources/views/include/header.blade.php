<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
</head>

<body>

    <header class="header fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark header__menu">
            <div class="container">
                <h1 class="navbar-brand mb-0 h1">Lucas Store Test</h1>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                    aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="menu">
                    <ul class="navbar-nav nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order') }}" class="menu__nave--item">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('config') }}" class="menu__nave--item">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" class="menu__nave--item">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>