@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Novo Pedido</h1>

                <form action="{{ route('orders.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="status_id" value="1">
                    <div class="form-group">
                        <label for="name">Cliente</label>
                        <select class="form-control form-select" name="customer_id" aria-label="Default select example">
                            <option>Selecione o cliente</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="order_date">Data do pedido</label>
                        <input type="date" class="form-control" name="order_date" id="order_date">
                    </div>
                    <div class="form-group">
                        <label for="name">Produto</label>
                        <select class="form-control form-select" name="product_id" aria-label="Default select example">
                            <option>Selecione o produto</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantidade</label>
                        <input type="number" step="1" min="0" class="form-control" name="quantity" id="quantity" required>
                    </div>
                    <button class="btn btn-outline-primary">Adicionar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
