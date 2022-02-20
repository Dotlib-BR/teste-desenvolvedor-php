@extends('layouts.app')

@section('content')

<h3 class="page-title">Clientes</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('client.get.list') }}">Clientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gerenciar Clientes</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> Cliente - Atualização </h4>
            <p class="card-description"> Editar Cliente </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="forms-sample" method="POST" action="{{ route('client.put.edit', $client->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="exampleInputName" class="col-sm-3 col-form-label">Nome</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Nome"
                            required minlength="3" value="{{ $client->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputCPF" class="col-sm-3 col-form-label">CPF</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputCPF" name="cpf" placeholder="CPF Ex: 123.123.123-01"
                            required minlength="14" maxlength="14" pattern="\d{11}" value="{{ $client->cpf }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail" class="col-sm-3 col-form-label">E-mail</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="exampleInputEmail" name="email" placeholder="E-mail" value="{{ $client->email }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Atualizar</button>
                <a href="{{ route('client.get.list') }}" class="btn btn-gradient-secondary">Voltar</a>
            </form>
        </div>
    </div>

@endsection