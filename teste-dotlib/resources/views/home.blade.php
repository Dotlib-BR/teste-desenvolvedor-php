<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}">
</head>
<body>
    @include('templates.header')

    <h1 style="text-align: center">Página de home do sistema</h1>

    @if(!session('user'))
        <h3 style="text-align: center" class="mt-lg-5">Olá, para acessar nossos serviços você precisa fazer login ou se cadastrar em nossa plataforma.</h3>
    @elseif(session('user.admin'))
        <h3 style="text-align: center" class="mt-lg-5">Seja bem vindo ao nosso sistema, {{ session('user.name') }}. Aqui você pode manipular dados dos pedidos, produtos e qualquer de cliente etc.</h3>
    @elseif(session('user'))
        <h3 style="text-align: center" class="mt-lg-5">Seja bem vindo ao nosso sistema, {{ session('user.name') }}. Aqui você pode gerenciar seus pedidos, produtos etc.</h3>
    @endif

{{--    @foreach (session('user') as $error)--}}
{{--        <li>{{ $error }}</li>--}}
{{--    @endforeach--}}

    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
    <script>
        $('#logout').on('click', () => {
            window.location.href = '/logout';
        })
    </script>
</body>
</html>
