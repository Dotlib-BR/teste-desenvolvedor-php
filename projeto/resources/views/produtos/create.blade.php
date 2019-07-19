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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{route('produtos.store')}}">
                            @csrf                            
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" class="form-control" id="descricao" name="descricao">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="codbarras">Código de Barras</label>
                                    <input type="text" class="form-control" id="codbarras" name="codbarras">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="valUnt">Valor Unitário</label>
                                    <input type="text" class="form-control" id="valUnt" name="valorUnt">
                                </div>
                            </div>  
                            <button type="submit" class="btn btn-outline-secondary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection