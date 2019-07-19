@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Dados do Produto
                    </div>
                    <div class="card-body">
                        <form method="post" id="addProduto" action="{{route('itens.adicionar')}}">
                            @csrf
                            <input type="hidden" name="produto_id" value="{{$produto->id}}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nome">Nome</label>
                                    <input type="text" readonly class="form-control" id="nome" name="nome" value="{{$produto->nome}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" readonly class="form-control" id="descricao" name="descricao" value="{{$produto->descricao}}">
                                </div>                               
                                <div class="form-group col-md-4">
                                    <label for="valUnt">Valor Unitário</label>
                                    <input type="text" readonly class="form-control" id="valUnt" name="valorUnt" value="{{$produto->valorUnt}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="valUnt">Quantidade</label>
                                    <input type="number"class="form-control" id="qnt" required name="quantidade">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="valUnt">Subtotal</label>
                                    <input type="text" readonly class="form-control" id="subtotal" name="subtotal">
                                </div>
                            </div>  
                            <button type="submit" class="btn btn-outline-secondary">Adicionar ao carrinho</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection