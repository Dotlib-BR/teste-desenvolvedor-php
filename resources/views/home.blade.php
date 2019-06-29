@extends('layouts.app')

@section('content')
    @auth

    @else
        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-sm-9 col-md-7 col-lg-6 col-xl-5 mx-auto">
                    <div class="jumbotron">
                        <form action="" method="post">
                            <h3 class="text-center">Painel de Usuário</h3>
                            <hr class="mb-4">
                            <div class="input-group mb-1">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-transparent">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </span>
                                <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-prepend">
                                    <div class="input-group-text bg-transparent">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </span>
                                <input type="password" class="form-control" placeholder="Senha" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="pull-left checkbox-inline mt-2">
                                        <input type="checkbox"> Permanecer conectado
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <p class="text-center"><a href="#">Criar uma conta</a></p>
                </div>
            </div>
        </div>
    @endauth
@endsection
