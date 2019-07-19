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
                            
                        </div>
                        @if($pedido)  
                        <div class="row">
                            <div class="col-md-1"><strong>Pedido:</strong> {{$pedido->id}}</div>    
                            <div class="col-md-3"><strong>Cliente:</strong> {{$pedido->clientes->nome}}</div>
                            <div class="col-md-3"><strong>E-mail:</strong> {{$pedido->clientes->email}}</div>
                            <div class="col-md-4"><strong>Data do Pedido:</strong> {{$pedido->data}}</div>
                            <div class="col-md-3 my-3"><strong>Status:</strong> {{$pedido->getStatus($pedido->status)}}</div>
                        </div>
                        <br>
                        <br>
                        <table class="table">   
                            <thead>
                                <tr>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Valor Unitário</th>
                                    <th scope="col">Desconto</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($pedido->itensPedidos as $itens)
                                    <tr>
                                        
                                        <td>{{$itens->produtos->nome}}</td>
                                        <td>
                                            <div>
                                                @if(Auth::user()->perfil == 2 && $pedido->status == 1)
                                                <a href="" data-pedido="{{$pedido->id}}" data-produto="{{$itens->produtos->id}}" data-item="0" class="mr-3 removeItens"><i class="fas fa-minus-circle text-danger"></i> </a> 
                                                    {{$itens->quantidade}} 
                                                <a href="" data-produto="{{$itens->produtos->id}}" data-item="0" class="ml-3 addItens"><i class="fas fa-plus-circle text-primary"></i></a>
                                                <a href="" data-pedido="{{$pedido->id}}" data-produto="{{$itens->produtos->id}}" data-item="1"  class="btn-block removeItens">Remover Produto</a>
                                                @else
                                                {{$itens->quantidade}} 
                                                @endif
                                            </div>                                             
                                        </td>
                                        <td>R$ {{number_format($itens->produtos->valorUnt, 2, ',', '')}}</td>
                                        <td></td>
                                        <td>R$ {{$itens->subtotal}}</td>
                                    </tr>
                               @endforeach
                                    @if($pedido->descontos != null)
                                        <tr>
                                            <td colspan="5" class="text-right">
                                                <strong>Valor do Desconto: </strong> R$ -{{number_format($pedido->descontos->valor, 2, ',', ' ')}}
                                            </td>                                        
                                        </tr>
                                    @endif
                                    <tr>

                                        <td colspan="5" class="text-right">
                                            <strong>Total do pedido: </strong>R$ {{ number_format($pedido->valor, 2, ',', '')}}
                                        </td>                                        
                                    </tr>
                                    @if(Auth::user()->perfil == 2 && $pedido->status == 1)
                                    <tr>
                                        <td colspan="5" class="">
                                            <form class="form-inline float-right" action="{{route('itens.desconto')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="pedido" value="{{$pedido->id}}">
                                                <div class="form-group mb-2">
                                                    <label for="cupom" class="sr-only">Cupom de Desconto</label>
                                                    <input type="text" readonly class="form-control-plaintext" id="cupom" value="Cupom de Desconto">
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="cupomDes" class="sr-only"></label>
                                                    <input type="textr" class="form-control" id="cupomDes" name="desconto" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary mb-2">Validar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="5" class="text-right">
                                            
                                            <form action="{{route('pedidos.store')}}" method="post" id="atualizaPedido"> 
                                                @csrf
                                                <input type="hidden" name="pedido_id" value="{{$pedido->id}}">
                                                @if(Auth::user()->perfil == 2 && $pedido->status == 1)
                                                    <a class="btn btn-outline-primary" href="{{route('produtos')}}" role="button">Continuar Comprando</a>
                                                    <input type="hidden" name="status" value="2">
                                                    <button type="submit" class="btn btn-outline-info" href="{{route('produtos')}}">Finalizar Pedido</button>
                                                @endif
                                                @if(Auth::user()->perfil == 1 && $pedido->status == 2)
                                                    <input type="hidden" name="status">
                                                    <a class="btn btn-outline-primary pagamento" href="" role="button">Informar Pagamento</a>
                                                    <a class="btn btn-outline-danger cancelar" href="" role="button">Cancelar Pedido</a>
                                                @endif
                                            </form>
                                            
                                        </td>
                                    </tr>
                            </tbody>    
                        </table>
                        @else
                            <div class="col">
                                <div class="alert alert-danger">
                                    Pedido vazio
                                </div>
                            </div>
                        @endif                  
                    </div>
                </div>                
            </div>
        </div>        
    </div>
    <form action="{{route('itens.deletar')}}" method="post" id="removeItens">
        @csrf
        <input type="hidden" name="pedido" >
        <input type="hidden" name="produto">
        <input type="hidden" name="item">
    </form>
    <form action="{{route('itens.adicionar')}}" method="post" id="addItens">
        @csrf
        <input type="hidden" name="pedido_id" >
        <input type="hidden" name="produto_id">        
    </form>
   
@endsection