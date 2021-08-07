@extends('master.main')
@section('main')

    <div class="container my-5">
        <a type="button" class="btn btn-dark my-3" href="{{route('pedido.index')}}">Voltar</a>

        <table class="table">
            <thead class="table-dark">
            <tr>
                <th scope="col">Nome do produto</th>
                <th scope="col">Código de barras</th>
                <th scope="col">Valor</th>
                <th scope="col">Quantidade</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pedido->produtos as $produto)
                <tr>

                    <th scope="row">{{$produto->NomeProduto}}</th>
                    <td>{{$produto->CodBarras}}</td>
                    <td>R$ {{$produto->Valor}}</td>
                    <td>{{$produto->pivot->quantidade}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
