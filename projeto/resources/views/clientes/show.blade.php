@extends('layouts.app')
@section('content')
    <div class="container">
        
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Dados do Cliente
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif                                
                            </div>                    
                        </div>
                        <form method="post" action="{{route('clientes.store')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$cliente->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="{{$cliente->nome}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">E-mail</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{$cliente->email}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" value="{{$cliente->cpf}}">
                                </div>
                            </div>  
                            <button type="submit" class="btn btn-outline-secondary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col py-4">
                <div class="card">
                    <div class="card-header">
                        Pedidos do Cliente
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Pedido</th>
                                    <th scope="col">Data do Pedido</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">
                                        @if(Auth::user()->perfil == 2)    
                                            <a class="btn btn-outline-secondary" href="{{route('produtos')}}" role="button">Realizar Pedido</a>
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($cliente->pedidos)>0)  
                                    @foreach($cliente->pedidos as $pedido)
                                        <tr>
                                            <th scope="row">{{$pedido->id}}</th>
                                            <td>{{$pedido->data}}</td>
                                            <td>R$ {{number_format($pedido->valor, 2, ',', ' ')}}</td>
                                            <td>{{$pedido->getStatus($pedido->status)}}</td>
                                            <td>
                                                <a class="btn btn-outline-primary" href="{{route('itens.index', $pedido->id)}}" role="button">Detalhes</a>
                                                <a class="btn btn-outline-danger deletar" data-deletar="{{$pedido->id}}" role="button">Deletar</a>
                                            </td>
                                        </tr>
                                    @endforeach             
                                @else
                                    <tr>
                                        <td colspan="4">Não há pedidos cadastrados</td>
                                    </tr>
                                @endif
                            </tbody>
                            
                        </table>
                        <form action="{{route('pedidos.delete')}}" method="post" id="form-deletar">
                        @csrf
                        <input type="hidden" name="id">
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
@endsection