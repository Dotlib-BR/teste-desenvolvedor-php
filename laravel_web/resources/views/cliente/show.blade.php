@extends('layouts.app')

@section('template_title')
    {{ $cliente->name ?? 'Show Cliente' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Cliente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('clientes.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nome:</strong>
                            {{ $cliente->nome }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $cliente->email }}
                        </div>
                        <div class="form-group">
                            <strong>Cpf:</strong>
                            {{ $cliente->cpf }}
                        </div>
                        <div class="form-group">
                            <strong>Celular:</strong>
                            {{ $cliente->celular }}
                        </div>
                        <div class="form-group">
                            <strong>Data Nascimento:</strong>
                            {{ $cliente->data_nascimento }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $cliente->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
