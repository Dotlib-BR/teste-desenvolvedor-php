<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />
    <meta charset="utf-8"/>
    <title>Cadastro</title>
</head>
<body>
<main class="form-signin" style="margin-top: 10%">
    <form class="form-horizontal" action="{{ route('signup') }}" method="post">
        @csrf
        <h1 class="title-login-page">CADASTRO</h1>

        <div class="form-floating">
            <input class="form-control" type="name" id="name" name="name" required="" placeholder="Digite seu nome">
            <label for="name">Nome</label>
        </div>
        <div class="form-floating">
            <input class="form-control" type="cpf" id="cpf" name="cpf" required="" placeholder="Digite seu CPF">
            <label for="cpf">CPF</label>
        </div>
        <div class="form-floating">
            <input class="form-control" type="email" id="email" name="email" required="" placeholder="Digite seu email">
            <label for="email">Email</label>
        </div>
        <div class="form-floating">
            <input class="form-control" type="password" id="password" name="password" required="" placeholder="Digite sua senha">
            <label for="password">Senha</label>
        </div>

        <button class="w-100 btn btn-lg btn-success" type="submit">Cadastrar</button>
    </form>
</main>
</body>
</html>
