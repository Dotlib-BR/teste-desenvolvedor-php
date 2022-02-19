<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('site/style.css') }}">
</head>
<body>

    @include('templates.header')

    <div class="mx-auto mt-lg-5" style="width: 40%;">
        <form method="POST" action="{{ route('action.register') }}">
            @csrf
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input value="{{ old('name') }}" type="text" name="name" class="form-control" id="name">
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input value="{{ old('email') }}" type="email" name="email" class="form-control" id="email">
                </div>
            </div>

            <div class="row mb-3">
                <label for="cpf" class="col-sm-2 col-form-label">Cpf</label>
                <div class="col-sm-10">
                    <input value="{{ old('cpf') }}" type="text" name="cpf" class="form-control" id="cpf">
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label">Senha</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="password">
                </div>
            </div>

            <p style="text-align: right" class="align-content-center"><a href="/login">Já tem cadastro? Faça o login aqui.</a></p>

            <button type="submit" class="btn btn-primary mb-lg-5">Cadastrar</button>


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
        </form>
    </div>

    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#cpf').mask('999.999.999-99');
        });
    </script>
</body>
</html>
