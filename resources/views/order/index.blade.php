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

            <div class="col-12">
                @if (isset($orders))
                    @component('components.table')
                        <thead>
                                <th>Número do Pedido</th>
                                <th>Data do Pedido</th>
                                <th>Status</th>
                                <th>Desconto</th>
                                <th>Total</th>
                                <th></th>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->number }}</td>
                                    <td>{{ $order->date_order->format('d/m/Y') }}</td>
                                    <td>{{ $order->status->name }}</td>
                                    <td>R$ {{ $order->discount_full }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td class="text-center text-md-right">
                                        <a class="btn btn-sm btn-primary mb-2 mb-md-0" href="{{ route('orders.edit', $order->id) }}">Editar</a>
                                        <button class="btn btn-sm btn-danger" type="button" data-action="{{ route('orders.destroy', $order->id) }}" data-toggle="modal" data-target="#modalDestroyConfirm">Remover</button>
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