<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dot.Lib</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        {{-- <link rel="stylesheet" href="{{ url(mix('css/style.css')) }}"> --}}
        {{-- <link rel="stylesheet" href="/resources/css/style.css"> --}}

        <style>
  
        </style>

    </head>
    <body class="antialiased">
       
        <nav>
            <ul>
                <li> <a href="/">Index</a> </li>
                <li> <a href="/users">Clientes</a> </li>
                <li> <a href="/products">Produtos</a> </li>
                <li> <a href="/requests">Pedidos</a> </li>
            </ul>
        </nav> 

        <div>
            @yield('container')
        </div>

    </body>
</html>
