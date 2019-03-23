@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                @component('components.card')
                    <div class="row align-items-center">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <h3 class="mb-0">Informações de Cliente</h3>
                        </div>

                        <div class="col-sm-6 text-sm-right">
                            <a class="btn btn-secondary" href="{{ route('clients.edit', $client->id) }}">Editar Cliente</a>
                            <a class="btn btn-primary" href="{{ route('clients.index') }}">Listar Clientes</a>
                        </div>
                    </div>
                @endcomponent
            </div>

            <div class="col-12">
                @component('components.table')
                    <tbody>
                        <tr>
                            <th>Nome</th>
                            <td>{{ $client->name }}</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>{{ $client->email }}</td>
                        </tr>
                        <tr>
                            <th>CPF</th>
                            <td>{{ $client->cpf_full }}</td>
                        </tr>
                        <tr>
                            <th>Última Atualização</th>
                            <td>{{ $client->updated_at->format('d/m/Y \à\s H:i') }}</td>
                        </tr>
                    </tbody>
                @endcomponent
            </div>
        </div>
    </div>
@endsection