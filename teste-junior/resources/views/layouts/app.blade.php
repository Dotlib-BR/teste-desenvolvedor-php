<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/estilo.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>@yield('title', 'Listagem')</title>
</head>
<div id="interfaceTop">
  <header id="cabecalho">
      <nav id="menu">
          <ul class="mt-4">
            <a  href="/">Home</a>
            <a  href="/users">Usuários</a>
            <a  href="/produtos">Produtos</a>
            <a  href="#">Pedidos</a>
          </ul>
      </nav>
    </header>
  </div>
<body>
    @yield('content')
</body>
</html>
