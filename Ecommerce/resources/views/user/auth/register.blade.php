@extends('layouts.masterOut')

@section('title', 'Registro')
@section('content')
    @if (Session::get('error'))
        <h3>{{ Session::get('error') }}</h3>
    @endif

    <section class="card login__form">
        <div class="card-body">
            <h3 class="card-title text-center">Cadastro</h3>
            <div class="card-text">
                <form action="{{ route('registerValidate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input required type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm" placeholder="Nome">
                        <p class="text-danger">@error('name') {{ $message }} @enderror</p>
                    </div>
                    <div class="form-group">
                        <label for="email">Sobrenome</label>
                        <input required type="text" name="last_name" value="{{ old('last_name') }}" class="form-control form-control-sm" placeholder="Sobrenome">
                        <p class="text-danger">@error('last_name') {{ $message }} @enderror</p>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input required type="email" name="email" value="{{ old('email') }}" class="form-control form-control-sm" placeholder="E-mail">
                        <p class="text-danger">@error('email') {{ $message }} @enderror</p>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input required type="password" name="password" class="form-control form-control-sm" placeholder="Senha">
                        <p class="text-danger">@error('password') {{ $message }} @enderror</p>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" required name="document" id="cpf" maxlength="14" class="form-control form-control-sm" value="{{ old('document') }}" placeholder="CPF">
                        <p class="text-danger">@error('document') {{ $message }} @enderror</p>
                    </div>
            
                    <div>
                        <label for="imagem" class="form-label">Foto de perfil </label>
                        <input class="form-control" type="file" id="imagem" name="image">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                    <div class="sign-up">
                        Já tem uma conta? <a href="{{ route('login') }}">Entre aqui.</a>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
