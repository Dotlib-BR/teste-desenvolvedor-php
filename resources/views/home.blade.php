@extends('layouts.app')

@section('content')
    @auth
        <div class="container-fluid mb-3">
            <div class="row mb-3">
                <div class="col-md-4 mb-2">
                    @include('components.card', [
                        'type'  => 'statistic',
                        'title' => 'Usuários',
                        'icon'  => 'users',
                        'total' => $total['users']
                    ])
                </div>
                <div class="col-md-4 mb-2">
                    @include('components.card', [
                        'type'  => 'statistic',
                        'title' => 'Produtos',
                        'icon'  => 'tags',
                        'total' => $total['products']
                    ])
                </div>
                <div class="col-md-4 mb-2">
                    @include('components.card', [
                        'type'  => 'statistic',
                        'title' => 'Pedidos',
                        'icon'  => 'shopping-cart',
                        'total' => $total['orders']
                    ])
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="m-5 text-center">
                                    <p>
                                        <i class="far fa-smile-beam fa-5x"></i>
                                    </p>
                                    <p>
                                        <h4>Olá! Seja bem-vindo.</h4>
                                        Aqui você poderá criar, visualizar, alterar e excluir usuários, produtos e pedidos.<br />
                                        Basta acessar as opções no menu principal.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-sm-9 col-md-7 col-lg-6 col-xl-5 mx-auto">
                    <div class="jumbotron bg-white">
                        <h3 class="text-center">Painel de Usuário</h3>
                        <hr class="mb-4">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="input-group mb-1">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-transparent">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </span>
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="E-mail" value="{{ old('email') }}" required>
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
                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Senha" value="" required>
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
                    <p class="text-center mb-1">
                        <img src="{{ asset('images/logo-footer.png') }}" />
                    </p>
                    <p class="text-light text-center">
                        &copy; Copyright <a class="text-primary" href="https://dotlib.com" target="_blank">Dot.lib</a> {{ date('Y') }} - Todos os direitos reservados.
                    </p>
                </div>
            </div>
        </div>
    @endauth
@endsection
