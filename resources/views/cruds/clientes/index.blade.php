@extends('master.main')
@section('main')

    <div class="container my-5">
        <a type="button" class="btn btn-dark my-3" href="{{route('cliente.create')}}">Criar Cliente</a>

        <table class="table">
            <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">E-mail</th>
                <th scope="col">
                    Menu
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <th scope="row">{{$cliente->id}}</th>
                    <td>{{$cliente->NomeCliente}}</td>
                    <td class="cpf">{{$cliente->CPF}}</td>
                    <td>{{$cliente->Email}}</td>
                    <td><a type="button" class="btn btn-dark" href="{{ route('cliente.edit', $cliente->id) }}"> Editar </a>
                        <form method="POST" action="{{ route('cliente.delete', $cliente->id) }}"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" name="delete">Apagar</button>
                        </form>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
