@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Lista de Clientes</h2>
                    </div>
                    <div class="col-sm-6 text-sm-right">
                        <a class="btn btn-success" href="{{ route('clients.create') }}">Adicionar Cliente</a>
                    </div>

                    <div class="col-12">
                        @if (isset($clients))
                            @component('components.table')
                                <thead>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>CPF</th>
                                        <th></th>
                                </thead>
        
                                <tbody>
                                    @foreach ($clients as $client)    
                                        <tr>
                                            <td>{{ $client->user->name }}</td>
                                            <td>{{ $client->user->email }}</td>
                                            <td>{{ $client->user->cpf_full }}</td>
                                            <td class="text-right">
                                                <a class="btn btn-sm btn-primary" href="{{ route('clients.edit', $client->id) }}">Editar</a>
                                                <a class="btn btn-sm btn-danger" href="">Remover</a>
                                            </td>
                                        </tr>
                                    @endforeach          
                                </tbody>
                            @endcomponent
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection