@extends('layout.navbar')

@section('title', 'Clientes')

@section('style')

    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@endsection

@section('content')

    <body>
    <div class="container"  style="margin-top: 5%">
        <div style="display: flex;justify-content: space-between" class="card-header py-2 mb-3">
            <h1 class="mt-3">Clientes</h1>
            <div class="search-box mt-3">
                <div class="title-search-blog">Pesquisar</div>
                <form action="{{ route('clients.search') }}" method="POST">
                    @csrf
                    <input class="search-field" id="search" type="text" name="search" placeholder="Faça sua busca">
                </form>
            </div>
            <a href="{{ route("clientes.create") }}" class="btn btn-success my-2" style="margin-bottom: 1.5rem!important;">Novo Cliente</a>
        </div>
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Email</th>
                <th scope="col">Tipo</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id}}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->cpf }}</td>
                    <td>{{ $client->user->email }}</td>
                    <td>{{ $client->user->type }}</td>
                    <td>
                        <a type="button" title="Editar Cliente" class="btn btn-sm btn-warning" href="{{ route('clientes.edit', $client->id ) }}">Editar</a>
                        <!-- Botao apagar -->
                        <a><form action="{{ route('clientes.destroy', $client->id) }}" method="post">
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
        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#">1</a>
            <a class="active" href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
            <a href="#">&raquo;</a>
        </div>
    </div>
{{--    {{ $clients->links() }}--}}
    </body>

@endsection
