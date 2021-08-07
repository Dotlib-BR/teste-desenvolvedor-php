@extends('master.main')
@section('main')

    <div class="container my-5">
        <a type="button" class="btn btn-dark my-3" href="{{route('produto.create')}}">Criar Produto</a>

        <table class="table">
            <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome do produto</th>
                <th scope="col">Código de Barras</th>
                <th scope="col">Valor</th>
                <th scope="col">
                    Menu
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <th scope="row">{{$produto->id}}</th>
                    <td>{{$produto->NomeProduto}}</td>
                    <td>{{$produto->CodBarras}}</td>
                    <td>R$ {{$produto->Valor}}</td>
                    <td><a type="button" class="btn btn-dark" href="{{ route('produto.edit', $produto->id) }}"> Editar </a>
                        <form method="POST" action="{{ route('produto.delete', $produto->id) }}"
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
