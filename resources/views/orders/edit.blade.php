@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{ $order }}
                <hr>
                {{ $customers }}
                <hr>
                {{ $products }}
                <hr>


                <h1>Alterar Pedido</h1>

                <form action="{{ route('orders.update', $order) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="customer_id">Cliente</label>
                        <select class="form-control form-select" name="customer_id" id="customer_id">
                            <option>Selecione o cliente</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ ($customer->id == $order->customer_id) ? 'selected' : ''}}>{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="order_date">Data do pedido</label>
                        <input type="date" class="form-control" name="order_date" id="order_date" value="{{ $order->order_date }}">
                    </div>
                    <div class="form-group">
                        <label for="product_id">Produto</label>
                        <select class="form-control form-select" name="product_id" id="product_id">
                            <option>Selecione o produto</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ ($product->id == $order->product_id) ? 'selected' : ''}}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="quantity">Quantidade</label>
                        <input type="number" step="1" min="0" class="form-control" name="quantity" id="quantity" value="{{ $order->quantity }}" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Status</label>
                        <select class="form-control form-select" name="status_id">
                            <option>Selecione o status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ ($status->id == $order->status_id) ? 'selected' : ''}}>{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-outline-primary">Alterar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
