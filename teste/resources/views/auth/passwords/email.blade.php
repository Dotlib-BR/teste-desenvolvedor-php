@extends('layouts.main')

@section('title', 'Email')

@section('content')
    <div class="container-fluid bg-dotlib">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card card-auth flex-row my-5">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image -->
                    </div>
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h5 class="card-title text-center">Esqueci minha senha</h5>
                        <form class="form-auth" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-label-group">
                                <input type="email" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" autocomplete="email" required>
                                <label for="inputEmail">Email</label>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit">ENVIAR</button>
                            <a class="d-block text-center mt-2 small" href="{{ url('/') }}">Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
