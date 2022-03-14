@extends('layout.navbar')

@section('title', 'Produtos')

@section('style')

    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@endsection

@section('content')

    <body>
    <div class="container"  style="margin-top: 5%">
        <div style="display: flex;justify-content: space-between" class="card-header py-2 mb-3">
            <h1 class="mt-3">Produtos</h1>
            <div class="search-box mt-3">
                <form action="{{ route('products.search') }}" method="POST">
                    @csrf
                    <input class="search-field" id="search" type="text" name="search" placeholder="Faça sua busca">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </div>
            <a href="{{ route('produtos.create') }}" class="btn btn-success my-2" style="margin-bottom: 1.5rem!important;">Novo Produto</a>
        </div>
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Preço</th>
                <th scope="col">Código de barras</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>R$ {{ $product->price }}</td>
                    <td>{{ $product->bar_code }}</td>
                    <td>
                        <a href="{{ route('produtos.edit', $product->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <!-- Botao apagar -->
                        <a><form action="{{ route('produtos.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div>
            <nav class="d-flex justify-items-center justify-content-between">
                <div class="d-flex justify-content-between flex-fill d-sm-none">
                    <ul class="pagination">

                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">&laquo; Previous</span>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="http://localhost:8000/clientes?page=2" rel="next">Next &raquo;</a>
                        </li>
                    </ul>
                </div>

                <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
                    <div>
                        <ul class="pagination" style="display: inline-flex!important;">

                            <li class="page-item"><a class="page-link" href="http://localhost:8000/produtos">1</a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:8000/produtos?page=2">2</a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:8000/produtos?page=3">3</a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:8000/produtos?page=4">4</a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:8000/produtos?page=5">5</a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:8000/produtos?page=6">6</a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:8000/produtos?page=7">7</a></li>
                            <li class="page-item"><a class="page-link" href="http://localhost:8000/produtos?page=8">8</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>

    </div>
    </body>

@endsection

