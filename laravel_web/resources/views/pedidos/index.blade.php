@extends('layouts.app')

@section('template_title', 'Pedidos')

@section('content')

    <div class="card shadow">
        <div class="card-header text-center">
            <h2>Pedidos Cadastrados</h2>
        </div>
        <div class="card-body p-5">
            <div class="row mb-3">
                <div class="col-11 col-md-11">
                @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-double"></i>&nbsp;&nbsp; {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    @elseif ($message = Session::get('erro'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp; {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="col-1 col-md-1">
                    <a href="{{route('pedidos-create')}}" class="btn btn-outline-success"><i class="fas fa-shopping-basket fa-1x"></i></a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome Cliente</th>
                            <th scope="col">Nome Produto</th>
                            <th scope="col" class="text-center">Valor Pedido</th>
                            <th scope="col" class="text-center">Data Pedido</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <th scope="row"><a href="{{route('pedidos-show', ['id' => $pedido->id])}}" class="text-decoration-none text-black"><i class="fas fa-stream text-info"></i> {{$pedido->id}}</a></th>
                                <td><a href="{{route('clientes-show', ['id' => $pedido->cliente_id])}}" class="text-decoration-none text-black"><i class="fas fa-stream text-info"></i> {{$pedido->nome_cliente}}</a></td>
                                <td><a href="{{route('produtos-show', ['id' => $pedido->produto_id])}}" class="text-decoration-none text-black"><i class="fas fa-stream text-info"></i> {{$pedido->nome_produto}}</a></td>
                                <td class="text-center">R$ {{$pedido->valor_total}}</td>
                                <td class="text-center">{{date('d/m/Y H:i:s', strtotime($pedido->data_pedido))}}</td>
                                <td class="text-center">
                                    @if ($pedido->status == 2)
                                        <span class="badge bg-success">Pago</span>

                                    @elseif ($pedido->status == 1)
                                        <span class="badge bg-secondary">Em Aberto</span>

                                    @else
                                        <span class="badge bg-danger">Cancelado</span>
                                    @endif
                                </td>
                                <td class="d-flex gap-2 justify-content-center">
                                    <a href="{{route('pedidos-edit', ['id' => $pedido->id])}}" class="btn btn-outline-primary"><i class="fas fa-pen"></i></a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#pedido-{{$pedido->id}}"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="pedido-{{$pedido->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Excluir pedido</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Você realmente deseja excluir o <b>Pedido - Nº{{$pedido->id}}</b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                            <form action="{{route('pedidos-destroy', ['id' => $pedido->id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Sim</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection