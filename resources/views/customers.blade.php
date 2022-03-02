@extends('layouts.main')

@section ('content')
<form action="{{ route('customers') }}" method="GET" class="filters mt-5 row">
    <header class="mb-3 d-flex justify-content-between align-items-center">
        <h2>Clientes</h2>

        <button class="btn btn-secondary">
            <a href="{{ route('createCustomer') }}" class="link-light" style="text-decoration: none">Adicionar</a>
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
            <option value="id|asc"{{ $order_by === 'id|asc' ? ' selected' : null }}>Id | crescente</option>
            <option value="id|desc"{{ $order_by === 'id|desc' ? ' selected' : null }}>Id | Decrescente</option>

            <option value="cpf|asc"{{ $order_by === 'cpf|asc' ? ' selected' : null }}>CPF | crescente</option>
            <option value="cpf|desc"{{ $order_by === 'cpf|desc' ? ' selected' : null }}>CPF | Decrescente</option>

            <option value="name|asc"{{ $order_by === 'name|asc' ? ' selected' : null }}>Nome | crescente</option>
            <option value="name|desc"{{ $order_by === 'name|desc' ? ' selected' : null }}>Nome | Decrescente</option>

            <option value="email|asc"{{ $order_by === 'email|asc' ? ' selected' : null }}>Email | crescente</option>
            <option value="email|desc"{{ $order_by === 'email|desc' ? ' selected' : null }}>Email | Decrescente</option>
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
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">Email</th>
            <th scope="col">Editar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <th scope="row">{{ $customer->id }}</th>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->cpf }}</td>
                <td>{{ $customer->email }}</td>
                <td>

                    <form action="{{ route('destroyCustomer', ['customer' => $customer->id]) }}" method="POST">
                        <button class="btn btn-info" type="button">
                            <a class="link-light" href="{{ route('editCustomer', ['customer' => $customer->id]) }}" style="text-decoration: none">
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
