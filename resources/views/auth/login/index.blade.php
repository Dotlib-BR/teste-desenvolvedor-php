@extends('layouts.forms_externos')

@section('content')
<div class="unix-login">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-content">
                    <div class="login-form">
                        <h4>Acessar o Sistema</h4>
                        <form method="POST" action="{{ route('login_action') }}">
                            @csrf
                            <div class="form-group @error('email') has-error @enderror">
                                <label>Email :.</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                            </div>
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                            @endif
                            <div class="form-group">
                                <label>Senha :.</label>
                                <input type="password" class="form-control" name="password"
                                required autocomplete="current-password" placeholder="Senha">
                            </div>
                            @if ( $errors->has('password'))
                                <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                            @endif

                            <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Acessar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
