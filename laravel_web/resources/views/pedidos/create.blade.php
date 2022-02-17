@extends('layouts.app')

@section('template_title', 'Novo Pedido')

@section('content')
    
    <div class="card shadow">
        <div class="card-header text-center">
            <h2>Novo Pedido</h2>
        </div>
        <div class="card-body p-5">
            @if (isset($erro))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp; {{ $erro }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{route('pedidos-store')}}" method="post">
                @csrf
                <legend class="font-small form-control text-center"><i class="fas fa-shopping-cart"></i> Dados do Pedido</legend>
                <div class="row form-group">
                    <div class="col-12 col-md-6 py-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <select id="cliente" name="cliente" class="form-select @error('cliente') is-invalid @enderror">
                            <option value="" selected disabled>Escolha o Cliente</option>
                            @foreach ($clientes as $cliente)
                                <option @if(old('cliente') == $cliente->id) selected @endif value="{{$cliente->id}}">{{$cliente->id.' - '.$cliente->nome.' --- CPF: '.$cliente->cpf}}</option>
                            @endforeach
                        </select>
                        @error('cliente')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 py-3">
                        <label for="produto" class="form-label">Produto</label>
                        <select id="produto" name="produto" class="form-select @error('produto') is-invalid @enderror">
                            <option value="" selected disabled>Escolha o Produto</option>
                            @foreach ($produtos as $produto)
                                <option @if(old('produto') == $produto->id) selected @endif value="{{$produto->id}}">{{$produto->id.' - '.$produto->nome.' --- R$ '.$produto->valor.' --- Qtd: '.$produto->quantidade}}</option>
                            @endforeach
                        </select>
                        @error('produto')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12 col-md-6 py-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" id="quantidade" name="quantidade" value="{{old('quantidade')}}" placeholder="Informe a quantidade" min="1" max="100" class="form-control @error('quantidade') is-invalid @enderror">
                        @error('quantidade')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 py-3">
                        <label for="data_pedido" class="form-label">Data do Pedido</label>
                        <input type="datetime-local" id="data_pedido" name="data_pedido" value="{{old('data_pedido')}}" class="form-control @error('data_pedido') is-invalid @enderror">
                        @error('data_pedido')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 text-end">
                    <a class="btn btn-dark" href="{{route('pedidos-index')}}">Voltar</a>
                    <button class="btn btn-primary" type="submit">Novo</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection