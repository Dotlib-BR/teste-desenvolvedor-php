<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sistema de Gerenciamento Comercial</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('principal')}}">dot.lib</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-item nav-link" href="{{route('lista.clientes')}}">Clientes</a>
          </li>
          <li class="nav-item">

            <a class="nav-item nav-link" href="{{route('lista.produtos')}}">Produtos</a>
          </li>

          <li class="nav-item">
            <a class="nav-item nav-link" href="{{route('lista.pedidos')}}">Pedidos de Compra</a>
          </li>
          <li class="nav-item">

            <a class="nav-item nav-link" href="{{route('efetuar.logout')}}">Efetuar Logout</a>
          </li>
        </ul>





      <span class="navbar-text">
        <b>Usuário Autenticado:</b> {{$usuario_autenticado_nome}}
      </span>

    </div>
  </nav>


  <div class="container">
    <div class="row">
      <div class="col-sm-12">


        @yield('conteudo')




      </div>
    </div>
  </div>

</body>

</html>