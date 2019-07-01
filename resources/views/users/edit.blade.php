@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h5 class="card-title">Editar Usuário</h5>
                    <hr>
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="" class="mb-0 font-weight-bold">Nome</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-user }}"></i>
                                        </div>
                                    </span>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Nome" maxlength="100" value="{{ old('name', $user->name) }}" required>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="" class="mb-0 font-weight-bold">E-mail</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-envelope }}"></i>
                                        </div>
                                    </span>
                                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="E-mail" maxlength="255" value="{{ old('email', $user->email) }}" required>
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="" class="mb-0 font-weight-bold">Senha</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-lock }}"></i>
                                        </div>
                                    </span>
                                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Senha" maxlength="255" value="">
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="" class="mb-0 font-weight-bold">CPF</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-id-card }}"></i>
                                        </div>
                                    </span>
                                    <input type="text" name="document" class="form-control {{ $errors->has('document') ? 'is-invalid' : '' }}" placeholder="CPF" maxlength="11" value="{{ old('document', $user->document) }}" required>
                                    @if ($errors->has('document'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('document') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-xl-2 offset-sm-3 offset-md-4 offset-xl-5 text-center mt-2">
                                <button type="submit" class="btn btn-primary btn-block">Editar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
