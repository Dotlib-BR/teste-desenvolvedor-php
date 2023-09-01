@extends('layouts.auth-master')

@section('content')
<div class="register-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <label class="h1"><b>{{ config('app.name', 'Laravel') }}</b></label>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Efetue o login para iniciar:</p>

            <form method="post" action="{{ route('login.perform') }}">
                @csrf

                <div class="input-group mb-3">
                    {{-- <label for="floatingName">Email or Username</label> --}}
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="E-mail" required="required" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Senha" required="required">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                        <input type="checkbox" id="remember" >
                        <label for="remember">
                            Lembrar-me
                        </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                <!-- /.col -->
                </div>

                @if (Session::has('message'))
                    <p> </p>
                    <div class="alert alert-success" role="alert" style="text-align:center">
                        <strong>{{ Session::get('message') }}</strong>
                    </div>
                @endif

                @if (Session::has('errors'))
                    @foreach ($errors->all() as $error)
                        <p> </p>
                        <div class="alert alert-danger" role="alert" style="text-align:center">
                            <strong>{{ $error }}</strong>
                        </div>
                    @endforeach
                @endif

            </form>

            {{-- // print all type of error messages which return withErrors() method
            @if(count($errors) > 0)
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            @endif

            //print error message by key name
            @error('custom_name')
            <p>{{$message}}</p>
            @enderror --}}

                {{-- <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> --}}
                <!-- /.social-auth-links -->
                <p> </p>
                <p class="mb-1">
                    <a href="{{ route('forget.show') }}"><strong>Esqueceu a senha?</strong></a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register.perform') }}" class="text-center"><strong>Registrar</strong></a>
                </p>
                @include('auth.partials.copy')
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</div>
@endsection
