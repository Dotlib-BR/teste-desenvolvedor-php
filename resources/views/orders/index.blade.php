@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Pedidos</h1>

                <a class="btn btn-primary mb-2" href="{{ route('orders.create') }}">Cadastrar pedido</a>

                @if(!empty($orders))
                    <table class="table table-bordered table-sm">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Data do pedido</th>
                            <th>Código de Barras</th>
                            <th>Nome Produto</th>
                            <th>Valor Unitário</th>
                            <th>Quantidade</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->customer->cpf }}</td>
                                <td>{{ $order->customer->email }}</td>
                                <td>{{ date('d/m/Y', strtotime($order->order_date)) }}</td>
                                <td>{{ $order->product->barcode }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ number_format($order->product->price, 2, ',', '.') }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td class="d-flex justify-content-around">
                                    <a class="btn btn-outline-info" href="{{ route('orders.edit', $order) }}"><i class="fas fa-edit"></i></a>
                                    <form id="delete-order-{{$order->id}}" method="POST" action="{{ route('orders.destroy', $order) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a class="btn btn-outline-danger" href="#" onclick="deleteConfirm('delete-order-{{$order->id}}')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                @else
                    <h2>Nenhum pedido cadastrado!</h2>
                @endif

            </div>
        </div>
    </div>
@endsection
