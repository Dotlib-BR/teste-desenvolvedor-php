<!DOCTYPE html>

<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">

  <title>Efetuar Cadastro</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link href="login.css" rel="stylesheet">
</head>

<body class="text-center" cz-shortcut-listen="true">

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])


  <form class="form-signin" method="post" action="{{route('efetuar.cadastro.usuario')}}">
  {{ csrf_field() }}

    <img class="mb-4" src="https://dotlib.com//theme/img/logos/logo.png">
    <h1 class="h3 mb-3 font-weight-normal">Efetue o Login!</h1>

    <label for="inputEmail" class="sr-only">Nome Completo</label>
    <input type="text" name="nome" id="inputEmail" class="form-control" placeholder="Fulano da Silva" required="" autofocus="">
    

    <label for="inputEmail" class="sr-only">Endereço de E-mail</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="fulano@gmail.com" required="" autofocus="">
    
    <label for="inputPassword" class="sr-only">Senha</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="123456789" required="">

    <button class="btn btn-lg btn-success btn-block" type="submit">Efetuar Cadastro</button>
    <a href="{{route('pagina.login')}}" class="btn btn-lg btn-danger btn-block">Já Possuo Uma Conta</a>
  </form>


</body>

</html>