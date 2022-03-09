@extends('layouts.main')

@section ('content')
<form action="{{ route('orders') }}" method="GET" class="filters mt-5 row">
    <header class="mb-3 d-flex justify-content-between align-items-center">
        <h2>Pedidos</h2>

        <button class="btn btn-secondary">
            <a href="{{ route('createOrder') }}" class="link-light" style="text-decoration: none">Adicionar</a>
        </button>
    </header>

    <div class="col-3">
        <label for="search_term" class="form-label">Termos de busca</label>
        <input type="text" name="search_term" class="form-control" id="search_term" aria-describedby="Search term" value="{{ $search_term }}" />
    </div>

    <div class="col-3">
        <label for="per_page" class="form-label">Items por página</label>
        <select class="form-select" aria-label="Select Items per page" name="per_page" id="per_page">
            <option value="20"{{ $per_page === 20 ? ' selected' : null }}>20 items</option>
            <option value="50"{{ $per_page === 50 ? ' selected' : null }}>50 items</option>
            <option value="100"{{ $per_page === 100 ? ' selected' : null }}>100 items</option>
            <option value="250"{{ $per_page === 250 ? ' selected' : null }}>250 items</option>
            <option value="500"{{ $per_page === 500 ? ' selected' : null }}>500 items</option>
        </select>
    </div>

    <div class="col-3">
        <label for="order_by" class="form-label">Ordernar por</label>
        <select class="form-select" aria-label="Order items" name="order_by" id="order_by">
            <option value="id|asc"{{ $order_by === 'id|asc' ? ' selected' : null }}>Id | Crescente</option>
            <option value="id|desc"{{ $order_by === 'id|desc' ? ' selected' : null }}>Id | Decrescente</option>

            <option value="id_product|asc"{{ $order_by === 'id_product|asc' ? ' selected' : null }}>Id (Produto) | Crescente</option>
            <option value="id_product|desc"{{ $order_by === 'id_product|desc' ? ' selected' : null }}>Id (Produto) | Decrescente</option>

            <option value="id_customer|asc"{{ $order_by === 'id_customer|asc' ? ' selected' : null }}>Id (Cliente) | Crescente</option>
            <option value="id_customer|desc"{{ $order_by === 'id_customer|desc' ? ' selected' : null }}>Id (Cliente) | Decrescente</option>

            <option value="date|asc"{{ $order_by === 'date|asc' ? ' selected' : null }}>Data | Crescente</option>
            <option value="date|desc"{{ $order_by === 'date|desc' ? ' selected' : null }}>Data | Decrescente</option>
        </select>
    </div>

    <div class="col-3 d-flex flex-column justify-content-end">
        <button type="submit" class="btn w-100 btn-primary">Filtrar</button>
    </div>
</form>

<table class="table mt-5">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Produto</th>
            <th scope="col">Preço</th>
            <th scope="col">Data</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <th scope="row">{{ $order->id }}</th>
                <td>
                    #{{ $order->customer->id }} - {{ $order->customer->cpf }} - {{ $order->customer->name }}
                </td>
                <td>
                    #{{ $order->product->id }} - {{ $order->product->code }} - {{ $order->product->name }}
                </td>
                <td>
                    R$ {{ $order->product->value }}
                </td>
                <td>{{ $order->date }}</td>
                <td>

                    <form action="{{ route('destroyOrder', ['order' => $order->id]) }}" method="POST">
                        <button class="btn btn-info" type="button">
                            <a class="link-light" href="{{ route('editOrder', ['order' => $order->id]) }}" style="text-decoration: none">
                                Editar
                            </a>
                        </button>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">
                            Deletar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

