@extends('layouts.app')

@section('template_title', 'Visualizar Cliente')

@section('content')
    
    <div class="card shadow">
        <div class="card-header text-center">
            <h2>Visualizar Cliente</h2>
        </div>
        <div class="card-body p-5">
            <p><i class="fa fa-clock"></i> Última alteração: {{date('d/m/Y H:i:s', strtotime($cliente->updated_at))}}</p>
            <legend class="font-small form-control text-center"><i class="fas fa-user-tie"></i> Dados Pessoais</legend>
            
            <div class="row">
                <div class="col-12 col-md-6 text-center">
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>ID:</strong>
                            {{ $cliente->id }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Nome:</strong>
                            {{ $cliente->nome }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Email:</strong>
                            {{ $cliente->email }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Cpf:</strong>
                            {{ $cliente->cpf }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Celular:</strong>
                            {{ $cliente->celular }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Data Nascimento:</strong>
                            {{ date('d/m/Y', strtotime($cliente->data_nascimento)) }}
                        </p>
                    </div>
                    <div class="form-group mb-2">
                        <p class="fs-3 m-0">
                            <strong>Status:</strong>
                            {{ $cliente->status == 1 ? 'Ativo' : 'Inativo' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center gap-3 mt-2">
                    <div>
                        <a class="btn btn-primary" href="{{route('clientes-index')}}">Clientes</a>
                    </div>
                    <div>
                        <a class="btn btn-secondary" href="{{route('clientes-edit', ['id' => $cliente->id])}}">Editar</a>
                    </div>
                    <div>
                        <a class="btn btn-dark" href="javascript:history.back()">Voltar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
@endsection