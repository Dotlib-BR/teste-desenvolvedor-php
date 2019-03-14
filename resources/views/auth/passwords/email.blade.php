@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row h-full justify-content-center align-items-center">
        <div class="col-md-6">
            @component('components.card')
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <h1 class="font-weight-bold text-center pb-4">Resetar Senha</h1>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-block">
                                Enviar Link de Redefinição
                            </button>
                        </div>
                    </div>
                </form>
            @endcomponent
        </div>
    </div>
</div>
@endsection
