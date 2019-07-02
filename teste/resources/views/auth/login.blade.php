@extends('layouts.main')

@section('title', 'Login')

@section('content')
    <div class="container-fluid bg-dotlib">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card card-auth flex-row my-5">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Login</h5>
                        <form class="form-auth" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-label-group">
                                <input type="email" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
                                <label for="inputEmail">Email</label>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-label-group">
                                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                <label for="inputPassword">Senha</label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-dark" href="{{ route('password.request') }}">
                                            Esqueceu sua senha?
                                        </a>
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-label-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="inputRemember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label text-dark" for="inputRemember">Lembrar senha</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit">Login</button>

                            @if (Route::has('register'))
                                <a class="d-block text-dark text-center mt-2 small" href="{{ route('register') }}">Cadastro</a>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
