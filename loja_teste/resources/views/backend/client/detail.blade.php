@extends('layouts.app')

@section('content')
    <h3 class="page-title">Clientes</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('client.get.list') }}">Clientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $client->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">
                        <i class="mdi mdi-account-circle icon-md text-success"></i> {{ $client->name }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Datos Pessoais</h5>
                    <p class="card-description">Cliente - Informações</p>
                    <p class="font-weight-bold"> Nome</p>
                    <p class="mb-5">{{ $client->name }}</p>
                    <p class="font-weight-bold">CPF</p>
                    <p class="mb-5">{{ $client->cpf }}</p>
                    <p class="font-weight-bold">E-mail</p>
                    <p class="mb-5">{{ $client->email }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Compras</h5>
                    <p class="card-description">Em implementação</p>
                </div>
            </div>
        </div>

    </div>
@endsection
