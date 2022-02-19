@extends('_template')

@section('content')
    <h1 class="text-center mt-4">Clientes <a href="{{ route('web.create', ['table' => 'cliente']) }}" class=""><i class="bi-plus-square"></i></a></h1>
    <div class="row mt-4">
        <div class="col text-center text-muted">
            <div class="container-lg">
                <table class="table rounded-top border">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col"><a href="{{ route('web.filterClients', ['filter' => 'name']) }}">Nome</a></th>
                            <th scope="col"><a href="{{ route('web.filterClients', ['filter' => 'cpf']) }}">CPF</a></th>
                            <th scope="col"><a href="{{ route('web.filterClients', ['filter' => 'email']) }}">Email</a>
                            </th>
                            <th scope="col"></th>  
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->name }} </td>
                                <td>{{ $client->cpf }}</td>
                                <td>{{ $client->email }}</td>
                                <td><a href="{{ route('web.view', ['table' => 'cliente', 'id' => $client->id]) }}"><i
                                            class="bi-eye"></i></a></td>
                                <td><a href="{{ route('web.edit', ['table' => 'cliente', 'id' => $client->id]) }}"><i
                                            class="bi-pencil-square"></i></a></td>
                                <td>
                                    <form action="{{ route('client.destroy', ['client' => $client->id]) }}" method="post">
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
                {{ $clients->links() }}
            </div>
        </div>
    </div>
@endsection
