@extends('layouts.empresa')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">Meus dados</div>

                <div class="card-body">
                    <form class="mb-2" action="{{ route('dashboard.empresa.perfil.delete', auth()->id()) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-primary" title="Excluir" onclick="return confirm('Deseja realmente excluir a sua conta?')">Deletar minha conta</button>
                    </form>

                    <form method="POST" action="{{ route('dashboard.empresa.perfil.update', auth()->id()) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">Dados da Empresa</div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-6 col-md-6">
                                        <label for="nome" class="col-md-4 col-form-label text-md-right">Nome</label>

                                        <div class="col-md-12">
                                            <input id="nome" type="text" class="form-control @error('empresa.nome') is-invalid @enderror" name="empresa[nome]" value="{{ $user->empresa->nome }}" required autocomplete="nome" autofocus>

                                            @error('empresa.nome')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <label for="cnpj" class="col-md-4 col-form-label text-md-right">CNPJ</label>

                                        <div class="col-md-12">
                                            <input id="cnpj" type="text" class="form-control @error('empresa.cnpj') is-invalid @enderror" name="empresa[cnpj]" value="{{ $user->empresa->cnpj }}" required autocomplete="cnpj">

                                            @error('empresa.cnpj')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-6 col-md-6">
                                        <label for="endereco" class="col-md-4 col-form-label text-md-right">Endereço</label>

                                        <div class="col-md-12">
                                            <input id="endereco" type="text" class="form-control @error('empresa.endereco') is-invalid @enderror" name="empresa[endereco]" value="{{ $user->empresa->endereco }}" required autocomplete="endereco" autofocus>

                                            @error('empresa.endereco')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <label for="telefone" class="col-md-4 col-form-label text-md-right">Telefone</label>

                                        <div class="col-md-12">
                                            <input id="telefone" type="text" class="form-control @error('empresa.telefone') is-invalid @enderror" name="empresa[telefone]" value="{{ $user->empresa->telefone }}" required autocomplete="telefone">

                                            @error('empresa.telefone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-3">
                                        <label for="celular" class="col-md-4 col-form-label text-md-right">Celular</label>

                                        <div class="col-md-12">
                                            <input id="celular" type="text" class="form-control @error('empresa.celular') is-invalid @enderror" name="empresa[celular]" value="{{ $user->empresa->celular }}" required autocomplete="celular">

                                            @error('empresa.celular')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-md-12">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email da Empresa</label>

                                        <div class="col-md-12">
                                            <input id="endereco" type="text" class="form-control @error('empresa.email') is-invalid @enderror" name="empresa[email]" value="{{ $user->empresa->email }}" required autocomplete="email" autofocus>

                                            @error('empresa.email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">Dados de Acesso</div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-6 col-md-6">
                                        <label for="nome_usuario" class="col-md-4 col-form-label text-md-right">Nome do Usuário</label>

                                        <div class="col-md-12">
                                            <input id="nome_usuario" type="text" class="form-control @error('usuario.nome') is-invalid @enderror" name="usuario[nome]" value="{{ $user->nome }}" required autocomplete="nome_usuario" autofocus>

                                            @error('usuario.nome')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <label for="email_acesso" class="col-md-4 col-form-label text-md-right">Email de acesso</label>

                                        <div class="col-md-12">
                                            <input id="email_acesso" type="email" class="form-control @error('usuario.email') is-invalid @enderror" name="usuario[email]" value="{{ $user->email }}" required autocomplete="email">

                                            @error('usuario.email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-6 col-md-6">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>

                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control @error('usuario.password') is-invalid @enderror" name="usuario[password]" autocomplete="current-password">

                                            @error('usuario.password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar a senha</label>

                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control" name="usuario[password_confirmation]" autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Atualizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
