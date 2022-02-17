@extends('layouts.app')

@section('template_title', 'Editar Pedido')

@section('content')
    
    <div class="card shadow">
        <div class="card-header text-center">
            <h2><i class="fas fa-boxes"></i> Pedido - Nº{{$pedido->id}}</h2>
        </div>
        <div class="card-body p-5">
            <p><i class="fa fa-clock"></i> Última alteração: {{date('d/m/Y H:i:s', strtotime($pedido->updated_at))}}</p>
            <form action="{{route('pedidos-update', ['id' => $pedido->id])}}" method="post">
            @csrf
            @method('PUT')
                <legend class="font-small form-control text-center"><i class="fas fa-shopping-cart"></i> Dados do Pedido</legend>
                <div class="row form-group">
                    <div class="col-12 col-md-5 py-3">
                        <label for="cliente_nome" class="form-label">Nome Cliente</label>
                        <input id="cliente_nome" type="text" value="{{$pedido->nome_cliente.' --- CPF: '.$pedido->cpf_cliente}}" class="form-control" readonly />
                    </div>
                    <div class="col-12 col-md-5 py-3">
                        <label for="cliente_produto" class="form-label">Nome Produto</label>
                        <input id="cliente_produto" type="text" value="{{$pedido->nome_produto.' --- R$ '.$pedido->valor_un_produto}}" class="form-control" readonly />
                    </div>
                    <div class="col-12 col-md-2 py-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input id="quantidade" type="text" value="{{$pedido->quantidade.' un'}}" class="form-control" readonly />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12 col-md-6 py-3">
                        <label for="data_pedido" class="form-label">Data do Pedido</label>
                        <input type="datetime-local" id="data_pedido" name="data_pedido" value="{{date('Y-m-d\Th:m',  strtotime($pedido->data_pedido))}}" class="form-control @error('data_pedido') is-invalid @enderror">
                        @error('data_pedido')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 py-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="0" {{$pedido->status == 0 ? 'selected' : ''}}>Cancelado</option>
                            <option value="1" {{$pedido->status == 1 ? 'selected' : ''}}>Em aberto</option>
                            <option value="2" {{$pedido->status == 2 ? 'selected' : ''}}>Pago</option>
                            <option value="" disabled>Escolha</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-12 text-end pt-3 pb-0">
                    <a class="btn btn-dark" href="{{route('pedidos-index')}}">Voltar</a>
                    <button class="btn btn-primary" type="submit" {{$pedido->status == 0 || $pedido->status == 2 ? 'disabled' : ''}}>Salvar</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection