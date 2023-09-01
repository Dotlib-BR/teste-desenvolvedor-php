@extends('layouts.auth-master')

@section('content')
    <div class="register-box">
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <label class="h1"><b>{{ config('app.name', 'Laravel') }}</b></label>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Registrar Usuário</p>

            <form method="post" action="{{ route('register.perform') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nome Completo" required="required" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}&emsp;&emsp;&emsp;</span>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email"  id="email" value="{{ old('email') }}"
                    onkeyup="transferirValor();" placeholder="E-mail" required="required" autofocus>
                    <input type="hidden" name="username" id="username">
                    <input type="hidden" name="token"  value="{{ csrf_token() }}" />
                    <input type="hidden" name="level"  value="0" />
                    <input type="hidden" name="status" value="0" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                        <br><span class="text-danger text-left">{{ $errors->first('email') }}&emsp;&emsp;&emsp;</span>
                    @endif
                </div>

              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Senha" required="required">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                @if ($errors->has('password'))
                    <span class="text-danger text-left">{{ $errors->first('password') }}&emsp;</span>
                @endif
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirmar Senha" required="required">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}&emsp;</span>
                @endif
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree" required="required" >
                    <label for="agreeTerms">
                     Concordo com os <a href="#">termos</a>
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Confirmar</button>
                </div>
                <!-- /.col -->
              </div>

              <p class="mb-0">
                <a href="{{ route('login.perform') }}" class="text-center"><strong>Login</strong></a>
              </p>
              @include('auth.partials.copy')
            </form>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>
      <!-- /.register-box -->
@endsection
