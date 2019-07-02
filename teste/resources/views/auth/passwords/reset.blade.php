@extends('layouts.main')

@section('title', 'Redefinir senha')

@section('content')
    <div class="container-fluid bg-dotlib">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card card-auth flex-row my-5">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Resetar senha</h5>
                        <form class="form-auth" method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-label-group">
                                <input type="email" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ $email ?? old('email') }}" autocomplete="email" required>
                                <label for="inputEmail">Email</label>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-label-group">
                                <input type="password" name="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                <label for="inputPassword">Senha</label>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-label-group">
                                <input type="password" name="password_confirmation" id="inputPasswordConfirmation" class="form-control" placeholder="Password" required autocomplete="new-password">
                                <label for="inputPasswordConfirmation">Confirmar senha</label>
                            </div>
                            <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit">Trocar senha</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
