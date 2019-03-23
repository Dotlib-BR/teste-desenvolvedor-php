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

            <div class="col-12 mb-3">
                <form action="{{ route('clients.filter') }}" method="get">
                    <div class="row">
                        <div class="col-12 mb-3">
                            @component('components.card')
                                @include('partials.filter', [
                                    'count_results' => request()->get('filter') ? $clients->count() : '',
                                    'options' => [
                                        'name' => 'Nome',
                                        'email' => 'E-mail',
                                        'cpf' => 'CPF',
                                    ],
                                    'placeholder' => 'Busque pelo nome, e-mail ou cpf do cliente.'
                                ])
                            @endcomponent
                        </div>

                        <div class="col-12 col-sm-3 col-md-2 mb-2">
                            @include('partials.paginate')
                        </div>
                            
                        <div class="col-12 col-sm-3 col-md-3 d-flex align-items-end mb-2">
                            @include('partials.bulk-actions', [
                                'actions' => [
                                    'delete' => route('clients.bulk-destroy')
                                ]
                            ])
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12">
                @if (isset($clients))
                    @component('components.table')
                        <thead>
                            <th class="d-none">
                                <input id="bulk-check-all" type="checkbox">
                            </th>
                            <th>
                                <a class="text-muted" href="{{ route('clients.filter', ['order' => 'name', 'sort' => request()->get('sort') == 'asc' ? 'desc' : 'asc']) }}">Nome</a>
                            </th>
                            <th>
                                <a class="text-muted" href="{{ route('clients.filter', ['order' => 'email', 'sort' => request()->get('sort') == 'asc' ? 'desc' : 'asc']) }}">E-mail</a>
                            </th>
                            <th>
                                <a class="text-muted" href="{{ route('clients.filter', ['order' => 'cpf', 'sort' => request()->get('sort') == 'asc' ? 'desc' : 'asc']) }}">CPF</a>
                            </th>
                            <th></th>
                        </thead>

                        <tbody>
                            @foreach ($clients as $client)    
                                <tr>
                                    <td class="d-none">
                                        <input class="bulk-check" type="checkbox" name="bulk[{{ $client->id }}]" value="{{ $client->id }}">
                                    </td>
                                    <td>
                                        <a href="{{ route('clients.show', $client->id) }}">{{ $client->name }}</a>
                                    </td>
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

                    <div class="d-flex justify-content-center mt-3">
                        {{ $clients->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('modal')
    @include('includes.modal-destroy-confirm')
@endpush