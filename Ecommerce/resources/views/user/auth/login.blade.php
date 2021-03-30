@extends('layouts.masterOut')

@section('title', 'login')
@section('content')

    <section class="card login__form">
        <div class="card-body">
            <h3 class="card-title text-center">Faça Login</h3>
            <div class="card-text">
                <form action="{{ route('validateLogin') }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control form-control-sm" id="email">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="password" class="form-control form-control-sm" id="senha">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>

                    <div class="sign-up">
                        Não tem uma conta ainda? <a href="{{route('register')}}">Cadastre-se.</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
