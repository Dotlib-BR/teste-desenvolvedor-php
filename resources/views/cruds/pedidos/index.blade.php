@extends('master.main')
@section('main')

    <div class="container my-5">
        <a type="button" class="btn btn-dark my-3" href="{{route('pedido.create')}}">Criar Pedido</a>

        <table class="table">
            <thead class="table-dark">
            <tr>
                <th scope="col">Número do pedido</th>
                <th scope="col">Nome do comprador</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Itens</th>
                <th scope="col">
                    Menu
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <th scope="row">{{$pedido->id}}</th>
                    <td>{{$pedido->Cliente->NomeCliente}}</td>
                    <td>R$ {{$pedido->ValorTotal}}</td>
                    <td>{{count($pedido->produtos)}}</td>
                    <td><a type="button" class="btn btn-primary" href="{{ route('pedido.show', $pedido->id) }}"> Ver </a>
                        <a type="button" class="btn btn-dark" href="{{ route('pedido.edit', $pedido->id) }}"> Editar </a>
                        <form method="POST" action="{{ route('pedido.delete', $pedido->id) }}"
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
