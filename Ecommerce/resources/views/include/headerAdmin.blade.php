<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/style.css')}}">
</head>
<body>

    <header class="menu">
        <div class="menu__container">
            <h1>Admin Teste</h1>
            <nav class="menu__nav">
                <a href="{{ route('registerView') }}">Produtos</a>
                <a href="{{ route('logoutAdmin') }}">Logout</a>
            </nav>
        </div>
    </header>