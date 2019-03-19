@extends('adminlte::page')

@section('title', 'Teste WebDev - Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Visualizar cliente</h3>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
        <div class="col-md-12">
            <table style="width:50%">
                <tr>
                    <th>Nome:</th>
                    <td>{{ $client->name }}</td>
                </tr>
                <tr>
                    <th>CPF:</th>
                    <td>{{ $client->cpf }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $client->email }}</td>
                </tr>
            </table><br><br>
        </div>
        <div class="col-md-12">
            <button type="button" class="btn btn-info"
                onclick="location.href='{{ route('clients.index') }}'">Voltar
            </button>
            </div>
        </div>
    </div>
@stop


