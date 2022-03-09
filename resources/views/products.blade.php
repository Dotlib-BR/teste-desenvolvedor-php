@extends('layouts.main')

@section ('content')
<form action="{{ route('products') }}" method="GET" class="filters mt-5 row">
    <input type="hidden" name="page" value="{{ $page }}" />

    <header class="mb-3 d-flex justify-content-between align-items-center">
        <h2>Produtos</h2>

        <button class="btn btn-secondary">
            <a href="{{ route('createProduct') }}" class="link-light" style="text-decoration: none">Adicionar</a>
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

            <option value="code|asc"{{ $order_by === 'code|asc' ? ' selected' : null }}>Código | Crescente</option>
            <option value="code|desc"{{ $order_by === 'code|desc' ? ' selected' : null }}>Código | Decrescente</option>

            <option value="name|asc"{{ $order_by === 'name|asc' ? ' selected' : null }}>Nome | Crescente</option>
            <option value="name|desc"{{ $order_by === 'name|desc' ? ' selected' : null }}>Nome | Decrescente</option>

            <option value="warehouse_quantity|asc"{{ $order_by === 'warehouse_quantity|asc' ? ' selected' : null }}>Quantidade | Crescente</option>
            <option value="warehouse_quantity|desc"{{ $order_by === 'warehouse_quantity|desc' ? ' selected' : null }}>Quantidade | Decrescente</option>

            <option value="value|asc"{{ $order_by === 'value|asc' ? ' selected' : null }}>Preço | Crescente</option>
            <option value="value|desc"{{ $order_by === 'value|desc' ? ' selected' : null }}>Preço | Decrescente</option>
        </select>
    </div>

    <div class="col-3 d-flex flex-column justify-content-end">
        <button type="submit" class="btn w-100 btn-primary">Filtrar</button>
    </div>
</form>

<x-pagination :page="$page" :last_page="$last_page" />

<table class="table mt-5">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Código</th>
            <th scope="col">Nome</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Preço</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->code }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->warehouse_quantity }}</td>
                <td>{{ $product->value }}</td>
                <td>

                    <form action="{{ route('destroyProduct', ['product' => $product->id]) }}" method="POST">
                        <button class="btn btn-info" type="button">
                            <a class="link-light" href="{{ route('editProduct', ['product' => $product->id]) }}" style="text-decoration: none">
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

