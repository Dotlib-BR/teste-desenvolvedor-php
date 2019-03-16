@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                @component('components.card')
                    <div class="row align-items-center">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <h3 class="mb-0">Lista de Clientes</h3>
                        </div>

                        <div class="col-sm-6 text-sm-right">
                            <a class="btn btn-success" href="{{ route('clients.create') }}">Adicionar Cliente</a>
                        </div>
                    </div>
                @endcomponent
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
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->cpf_full }}</td>
                                    <td class="text-center text-lg-right">
                                        <a class="btn btn-sm btn-primary mb-2 mb-lg-0" href="{{ route('clients.edit', $client->id) }}">Editar</a>
                                        <button class="btn btn-sm btn-danger" type="button" data-action="{{ route('clients.destroy', $client->id) }}" data-toggle="modal" data-target="#modalDestroyConfirm">Remover</button>
                                    </td>
                                </tr>
                            @endforeach          
                        </tbody>
                    @endcomponent
                @endif
            </div>
        </div>
    </div>
@endsection

@push('modal')
    @include('includes.modal-destroy-confirm')
@endpush