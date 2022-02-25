<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache" />
        <title>Dot.Lib</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">

        <style>
  
        </style>

    </head>
    <body class="">
       
        <nav>
            <ul class="nav-bar">
                <li> <a href="/">Início</a> </li>
                <li> <a href="/customers">Clientes</a> </li>
                <li> <a href="/products">Produtos</a> </li>
                <li> <a href="/requests">Pedidos</a> </li>
            </ul>
        </nav>

        <div class="container">
            @yield('container')
        </div>

    </body>
    <script src="{{ asset('js/global.js') }}"><script>
</html>
