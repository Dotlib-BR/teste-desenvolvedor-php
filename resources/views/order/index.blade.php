@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                @component('components.card')
                    <div class="row align-items-center">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <h3 class="mb-0">Lista de Pedidos</h3>
                        </div>

                        <div class="col-sm-6 text-sm-right">
                            <a class="btn btn-success" href="{{ route('orders.create') }}">Adicionar Pedido</a>
                        </div>
                    </div>
                @endcomponent
            </div>

            <div class="col-12 mb-3">
                <form action="{{ route('orders.filter') }}" method="get">
                    <div class="row">
                        <div class="col-12 mb-3">
                            @component('components.card')
                                @include('partials.filter', [
                                    'count_results' => request()->get('filter') ? $orders->count() : '',
                                    'options' => [
                                        'number' => 'Número do Pedido',
                                        'name' => 'Cliente',
                                        'date_order' => 'Data',
                                        'status_id' => 'Status',
                                        'discount' => 'Desconto',
                                    ],
                                    'placeholder' => 'Busque pelo número, cliente, data, status, desconto ou total do pedido.'
                                ])
                            @endcomponent
                        </div>

                        <div class="col-12 col-sm-2 mb-2">
                            @include('partials.paginate')
                        </div>

                        <div class="col-12 col-sm-3 col-md-3 d-flex align-items-end mb-2">
                            @include('partials.bulk-actions', [
                                'actions' => [
                                    'delete' => route('orders.bulk-destroy')
                                ]
                            ])
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12">
                @if (isset($orders))
                    @component('components.table')
                        <thead>
                            <th class="d-none">
                                <input id="bulk-check-all" type="checkbox">
                            </th>
                            <th>
                                <a class="text-muted" href="{{ route('orders.filter', ['order' => 'number', 'sort' => request()->get('sort') == 'asc' ? 'desc' : 'asc']) }}">Número do Pedido</a>
                            </th>
                            <th>
                                <a class="text-muted" href="{{ route('orders.filter', ['order' => 'client_id', 'sort' => request()->get('sort') == 'asc' ? 'desc' : 'asc']) }}">Cliente</a>
                            </th>
                            <th>
                                <a class="text-muted" href="{{ route('orders.filter', ['order' => 'date_order', 'sort' => request()->get('sort') == 'asc' ? 'desc' : 'asc']) }}">Data do Pedido</a>
                            </th>
                            <th>
                                <a class="text-muted" href="{{ route('orders.filter', ['order' => 'status_id', 'sort' => request()->get('sort') == 'asc' ? 'desc' : 'asc']) }}">Status</a>
                            </th>
                            <th>
                                <a class="text-muted" href="{{ route('orders.filter', ['order' => 'discount', 'sort' => request()->get('sort') == 'asc' ? 'desc' : 'asc']) }}">Desconto</a>
                            </th>
                            <th class="text-muted">Total</th>
                            <th></th>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="d-none">
                                        <input class="bulk-check" type="checkbox" name="bulk[{{ $order->id }}]" value="{{ $order->id }}">
                                    </td>
                                    <td>{{ $order->number }}</td>
                                    <td>
                                    <a href="{{ route('clients.show', $order->client->id) }}" target="_blank">{{ $order->client->name }}</a>
                                    </td>
                                    <td>{{ $order->date_order->format('d/m/Y') }}</td>
                                    <td>{{ $order->status->name }}</td>
                                    <td>R$ {{ $order->discount_full }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td class="text-center text-lg-right">
                                        <a class="btn btn-sm btn-primary mb-2 mb-lg-0" href="{{ route('orders.edit', $order->id) }}">Editar</a>
                                        <button class="btn btn-sm btn-danger" type="button" data-action="{{ route('orders.destroy', $order->id) }}" data-toggle="modal" data-target="#modalDestroyConfirm">Remover</button>
                                    </td>
                                </tr>
                            @endforeach          
                        </tbody>
                    @endcomponent

                    <div class="d-flex justify-content-center mt-3">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('modal')
    @include('includes.modal-destroy-confirm')
@endpush