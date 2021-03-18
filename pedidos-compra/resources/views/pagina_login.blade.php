<!DOCTYPE html>

<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">

  <title>Efetuar Login</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link href="login.css" rel="stylesheet">
</head>



<body class="text-center" cz-shortcut-listen="true">

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])


  <form class="form-signin" method="post" action="{{route('efetuar.login.usuario')}}">
  {{ csrf_field() }}

    <img class="mb-4" src="https://dotlib.com//theme/img/logos/logo.png">
    <h1 class="h3 mb-3 font-weight-normal">Efetue o Login!</h1>

    <label for="inputEmail" class="sr-only">Endereço de E-mail</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required="" autofocus="">

    <label for="inputPassword" class="sr-only">Senha</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="">

    <button class="btn btn-lg btn-primary btn-block" type="submit">Efetuar Login</button>
    <a href="{{route('pagina.cadastro')}}" class="btn btn-lg btn-warning btn-block">Efetuar Cadastro</a>
  </form>


</body>

</html>