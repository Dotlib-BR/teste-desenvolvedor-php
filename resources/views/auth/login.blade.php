@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row h-full justify-content-center align-items-center">
        <div class="col-md-6 col-lg-4">
            @component('components.card')
                <h1 class="font-weight-bold text-center pb-4">Login</h1>

                <form method="POST" action="{{ route('login') }}" aria-label="Login">
                    @csrf

                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Senha" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Lembrar-me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-block">
                                Entrar
                            </button>

                            <a class="btn btn-link text-muted" href="{{ route('password.request') }}">
                                Esqueceu a senha?
                            </a>
                        </div>
                    </div>
                </form>
            @endcomponent
        </div>
    </div>
</div>
@endsection