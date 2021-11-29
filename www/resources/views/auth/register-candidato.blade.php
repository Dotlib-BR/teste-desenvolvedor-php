@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">Cadastro de Candidato</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('auth.candidato.registro.submit') }}">
                        @csrf

                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">Dados Candidato</div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-6 col-md-6">
                                        <label for="nome" class="col-md-4 col-form-label text-md-right">Nome</label>

                                        <div class="col-md-12">
                                            <input id="nome" type="text" class="form-control @error('candidato.nome') is-invalid @enderror" name="candidato[nome]" value="{{ old('candidato.nome') }}" required autocomplete="nome" autofocus>

                                            @error('candidato.nome')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <label for="sobrenome" class="col-md-4 col-form-label text-md-right">Sobrenome</label>

                                        <div class="col-md-12">
                                            <input id="sobrenome" type="text" class="form-control @error('candidato.sobrenome') is-invalid @enderror" name="candidato[sobrenome]" value="{{ old('candidato.sobrenome') }}" required autocomplete="sobrenome">

                                            @error('candidato.sobrenome')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-6 col-md-4">
                                        <label for="cpf" class="col-md-4 col-form-label text-md-right">CPF</label>

                                        <div class="col-md-12">
                                            <input id="cpf" type="text" class="form-control @error('candidato.cpf') is-invalid @enderror" name="candidato[cpf]" value="{{ old('candidato.cpf') }}" required autocomplete="cpf" maxlength="14" autofocus>

                                            @error('candidato.cpf')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <label for="data_nascimento" class="col-md-6 col-form-label text-md-right">Data de Nascimento</label>

                                        <div class="col-md-12">
                                            <input id="data_nascimento" type="date" class="form-control @error('candidato.data_nascimento') is-invalid @enderror" name="candidato[data_nascimento]" value="{{ old('candidato.data_nascimento') }}" required autocomplete="data_nascimento">

                                            @error('candidato.data_nascimento')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <label for="genero" class="col-md-4 col-form-label text-md-right">Gênero</label>

                                        <div class="col-md-12">
                                            <select name="candidato[genero]" id="genero" class="form-control @error('candidato.genero') is-invalid @enderror" required>
                                                <option value="">Selecionar</option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Feminino</option>
                                                <option value="N">Não Definido</option>
                                            </select>

                                            @error('candidato.genero')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-md-6">
                                        <label for="endereco" class="col-md-4 col-form-label text-md-right">Endereço</label>

                                        <div class="col-md-12">
                                            <input id="endereco" type="text" class="form-control @error('candidato.endereco') is-invalid @enderror" name="candidato[endereco]" value="{{ old('candidato.endereco') }}" required autocomplete="endereco" autofocus>

                                            @error('candidato.endereco')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <label for="telefone" class="col-md-4 col-form-label text-md-right">Telefone</label>

                                        <div class="col-md-12">
                                            <input id="telefone" type="text" class="form-control @error('candidato.telefone') is-invalid @enderror" name="candidato[telefone]" value="{{ old('candidato.telefone') }}" required autocomplete="telefone" autofocus>

                                            @error('candidato.telefone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <label for="celular" class="col-md-4 col-form-label text-md-right">Celular</label>

                                        <div class="col-md-12">
                                            <input id="celular" type="text" class="form-control @error('candidato.celular') is-invalid @enderror" name="candidato[celular]" value="{{ old('candidato.celular') }}" required autocomplete="celular" autofocus>

                                            @error('candidato.celular')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-12 col-md-12">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email do Candidato</label>

                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control @error('candidato.email') is-invalid @enderror" name="candidato[email]" value="{{ old('candidato.email') }}" required autocomplete="email" autofocus>

                                            @error('candidato.email')
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
                                            <input id="nome_usuario" type="text" class="form-control @error('usuario.nome') is-invalid @enderror" name="usuario[nome]" value="{{ old('usuario.nome') }}" required autocomplete="nome_usuario" autofocus>

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
                                            <input id="email_acesso" type="email" class="form-control @error('usuario.email') is-invalid @enderror" name="usuario[email]" value="{{ old('usuario.email') }}" required autocomplete="email">

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
                                            <input id="password" type="password" class="form-control @error('usuario.password') is-invalid @enderror" name="usuario[password]" required autocomplete="current-password">

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
                                            <input id="password-confirm" type="password" class="form-control" name="usuario[password_confirmation]" required autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
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
