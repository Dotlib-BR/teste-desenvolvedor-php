<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cadastro de Pedidos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <script type="text/javascript" src="<?php echo asset('js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo asset('js/scripts.js')?>"></script>
         <!-- Tabela -->
        <script type="text/javascript" src="<?php echo asset('js/jquery_3_5_1.js'); ?>"></script>
        <link href="{{ asset('css/jquery_dataTable_min.css') }}" rel="stylesheet">
        <script type="text/javascript" src="<?php echo asset('js/jquery_1_11_3_dataTables_min.js'); ?>"></script>
         <!-- Tabela -->
    </head>
    <body>
        <div class="container-fluid">
            <div class="row one">
                <div class="col-2 menu-nav">
                    <ul class="nav menuNav-item">
                        <li class="nav-item">
                            <a class="nav-link ni-li active" href="/api/cliente">Clientes</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link ni-li" href="/api/produto">Produtos</a>
                        </li>
                        <a class="nav-link ni-li" href="/api/pedido">Pedidos de Compras</a>
                        </li>
                    </ul> 
                    <button type="button" class="btn btn-success btn-logout">
                        Sair
                    </button>
                </div>
                @yield('content')
            </div>
        </div>
        <script>
        $(document).ready( function () {
            $('#tabelaEditar').DataTable();
        } );
        </script>
    </body>
</html>
