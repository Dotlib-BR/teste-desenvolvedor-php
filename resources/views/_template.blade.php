<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>{{ $title . ' | ' . $_SERVER['HTTP_HOST'] }}</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="https://dotlib.com/theme/img/logos/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() === 'web.home' ? 'active' : '' }}"
                            aria-current="page" href="{{ route('web.home') }}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() === 'web.clients' ? 'active' : '' }}"
                            href="{{ route('web.clients') }}">CLIENTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() === 'web.products' ? 'active' : '' }}"
                            href="{{ route('web.products') }}">PRODUTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() === 'web.orders' ? 'active' : '' }}"
                            href="{{ route('web.orders') }}">PEDIDOS</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    @yield('content')

    <footer class="text-center bg-dark pt-3 text-light ">
        <p>Site Criado por <a href="https://github.com/netocastro" target="_blanck">Neto Castro</a> @2022</p>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
