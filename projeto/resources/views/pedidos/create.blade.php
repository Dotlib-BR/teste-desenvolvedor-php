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
                        @if(@empty($cliente))
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">E-mail</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf">
                                </div>
                            </div>  
                        @else
                            <p><strong>Cliente:</strong> {{$cliente->nome}}</p>
                            <p><strong>E-mail:</strong> {{$cliente->email}}</p>
                            <p><strong>CPF:</strong> {{$cliente->cpf}}</p>                        
                        @endif
                            <div class="form-row">
                                <div class="form-group col-md-6">                                    
                                    <input type="text" class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Pesquisar produto">                                    
                                </div>
                                <div class="form-group col-md-6">                                    
                                    <button type="button" class="btn btn-secondary" id="pesquisaProduto">Pesquisar</button>
                                </div>                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="hidden" name="idProduto">                                    
                                    <input type="text" readonly class="form-control-plaintext" name="nome" id="">
                                </div>
                                <div class="form-group col-md-4">                                    
                                    <input type="text" readonly class="form-control-plaintext" name="descricao" id="">
                                </div>
                                <div class="form-group col-md-3">                                    
                                    <input type="text" readonly class="form-control-plaintext" name="valorUnt" id="">
                                </div>
                               
                            </div>
                                
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produtos as $produto)
                                        <tr>
                                            <td>{{$produto->nome}}</td>
                                            <td>{{$produto->descricao}}</td>
                                            <td>{{$produto->valorUnt}}</td>
                                            <td><a class="btn btn-outline-info" href="{{route('produtos.show', $produto->id, $cliente->id)}}" role="button">Detalhes do Produto</a></td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            @isset($produtos)
                             {{ $produtos->links() }}
                            @endisset
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
@endsection
