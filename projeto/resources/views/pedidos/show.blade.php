@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Dados do Pedido
                    </div>
                    <div class="card-body">
                        <p><strong>Cliente:</strong> {{$pedido->clientes->nome}}</p>
                        <p><strong>Número do Pedido:</strong> {{$pedido->id}}</p>
                        <p><strong>Data do Pedido:</strong> {{$pedido->data}}</p>
                        <p><strong>Valor do Pedido R$:</strong> {{$pedido->valor}} </p>
                        <p><strong>Starus</strong> {{$pedido->status($pedido->status)}}</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Valor Unit.</th>
                                    <th scope="col">Quantidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedido->itensPedidos as $itens)
                                    <tr>
                                        <td>{{$itens->produtos->id}}</td>
                                        <td>{{$itens->produtos->nome}}</td>
                                        <td>{{$itens->produtos->descricao}}</td>
                                        <td>{{$itens->produtos->valorUnt}}</td>
                                        <td>{{$itens->produtos->id}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a class="btn btn-outline-primary" href="#" role="button">Editar Pedido</a> 
                        @if($pedido->status != 3) 
                            <a class="btn btn-outline-danger" href="#" role="button">Cancelar</a>  
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
@endsection