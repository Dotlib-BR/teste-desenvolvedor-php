@extends('_template')

@section('content')
    <h1 class="text-center mt-4">Pedidos <a href="{{ route('web.create', ['table' => 'pedido']) }}" class=""><i class="bi-plus-square"></i></a></h1>

    <div class="row my-4">
        <div class="col text-center text-muted">
            <div class="container">
                <table class="table table-striped">
                    <thead class="table-dark border border-rounded">
                        <tr>
                            <th scope="col"><a href="{{ route('web.filterOrders', ['filter' => 'id']) }}">N°</a></th>
                            <th scope="col"><a href="{{ route('web.filterOrders', ['filter' => 'created_at']) }}">Data</a></th>
                            <th scope="col"><a href="{{ route('web.filterOrders', ['filter' => 'client_id']) }}">Cliente</a></th>
                            <th scope="col"><a href="{{ route('web.filterOrders', ['filter' => 'product_id']) }}">Produto</a></th>
                            <th scope="col"><a href="{{ route('web.filterOrders', ['filter' => 'status']) }}">Status</a></th>
                            <th scope="col"><a href="{{ route('web.filterOrders', ['filter' => 'amount']) }}">Quant.</a></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->client_id }}</td>
                                <td>{{ $order->product_id }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->amount }}</td>
                                <td><a href="{{ route('web.view', ['table' => 'pedido', 'id' => $order->id]) }}"><i
                                    class="bi-eye"></i></a></td>
                                <td><a href="{{ route('web.edit', ['table' => 'pedido', 'id' => $order->id]) }}"><i
                                            class="bi-pencil-square"></i></a></td>
                                <td>
                                    <form action="{{ route('order.destroy', ['order' => $order->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0"><i class="bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row my-3">
            <div class="col d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
