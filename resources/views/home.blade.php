@extends('layouts.app')

@section('content')
    @auth
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-2">
                    @include('components.card', [
                        'type'  => 'statistic',
                        'icon'  => 'users',
                        'total' => rand() % 1000,
                        'title' => 'Usuários'
                    ])
                </div>
                <div class="col-md-4 mb-2">
                    @include('components.card', [
                        'type'  => 'statistic',
                        'icon'  => 'tags',
                        'total' => rand() % 1000,
                        'title' => 'Produtos'
                    ])
                </div>
                <div class="col-md-4 mb-2">
                    @include('components.card', [
                        'type'  => 'statistic',
                        'icon'  => 'shopping-cart',
                        'total' => rand() % 1000,
                        'title' => 'Pedidos'
                    ])
                </div>
            </div>
        </div>
    @else
        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-sm-9 col-md-7 col-lg-6 col-xl-5 mx-auto">
                    <div class="jumbotron bg-white">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <h3 class="text-center">Painel de Usuário</h3>
                            <hr class="mb-4">
                            <div class="input-group mb-1">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-transparent">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </span>
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="E-mail" required>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-transparent">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </span>
                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Senha" required>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="pull-left checkbox-inline mt-2">
                                        <input type="checkbox" name="remember"> Permanecer conectado
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-sign-in-alt"></i>
                                            Entrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
