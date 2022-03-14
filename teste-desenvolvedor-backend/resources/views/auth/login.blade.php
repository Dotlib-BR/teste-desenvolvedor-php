<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />
    <meta charset="utf-8"/>
    <title>Login</title>
</head>
<body>
<main class="form-signin" style="margin-top: 10%">
    <form class="form-horizontal" action="{{ route('login.post') }}" method="post">
        @csrf
        <h1 class="title-login-page">Login</h1>

        <div class="form-floating">
            <input class="form-control" type="email" id="email" name="email" required="" placeholder="Digite seu email">
            <label for="email">Email</label>
        </div>
        <div class="form-floating">
            <input class="form-control" type="password" id="password" name="password" required="" placeholder="Digite sua senha">
            <label for="password">Senha</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-success" type="submit">Entrar</button>
    </form>
</main>
</body>
</html>
