@extends('layouts.auth-master')

@section('content')
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <label class="h1"><b>{{ config('app.name', 'Laravel') }}</b></label>
        </div>
        <div class="card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
        <form action="{{ route('reset.perform') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-group mb-3">
                    <input type="email" id="email_address" class="form-control" placeholder="Digite seu endereço de E-mail"
                    onkeyup="this.value = this.value.toLowerCase();" value="{{ $email }}" name="email" required autofocus readonly>
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                    </div>
                </div>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Digite a nova senha" id="password" name="password" required autofocus>
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                    </div>
                </div>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirme a nova senha" id="password-confirm" name="password_confirmation" required autofocus>
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                    </div>
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Alterar Senha</button>
                </div>
            <!-- /.col -->
            </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{ route('login.perform') }}" class="text-center"><strong>Login</strong></a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection
