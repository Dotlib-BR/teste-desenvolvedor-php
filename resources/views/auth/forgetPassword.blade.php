@extends('layouts.auth-master')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <label class="h1"><b>{{ config('app.name', 'Laravel') }}</b></label>
        </div>
        <div class="card-body">
            <p class="login-box-msg">
                Você esqueceu sua senha?
                <br>Aqui você pode facilmente solicitar a criação de uma nova.
            </p>
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            <form action="{{ route('forget.perform') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ csrf_token() }}" />
                <div class="input-group mb-3">
                    <input type="email" id="email_address" class="form-control" name="email" placeholder="E-mail" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" style="text-align:center">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}&emsp;</span><br><br>
                        @endif
                        <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
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
@endsection
