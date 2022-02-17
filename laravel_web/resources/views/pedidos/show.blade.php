@extends('layouts.app')

@section('template_title', 'Visualizar Pedido')

@section('content')
    
    <div class="card shadow">
        <div class="card-header text-center">
            <h2>Visualizar Pedido</h2>
        </div>
        <div class="card-body p-5">
            <p><i class="fa fa-clock"></i> Última alteração: {{date('d/m/Y H:i:s', strtotime($pedido->updated_at))}}</p>
            <legend class="font-small form-control text-center"><i class="fas fa-shopping-cart"></i> Dados do Pedido</legend>
            
            <div class="row">
                <div class="col-12 col-md-6 text-center">
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>ID:</strong>
                            {{ $pedido->id }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Nome Cliente:</strong>
                            {{ $pedido->nome_cliente }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Email Cliente:</strong>
                            {{ $pedido->email_cliente }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>CPF Cliente:</strong>
                            {{ $pedido->cpf_cliente }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Cód. Barras Produto:</strong>
                            {{ $pedido->cod_barras_produto }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Nome Produto:</strong>
                            {{ $pedido->nome_produto }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Valor un. Produto:</strong>
                            R$ {{ $pedido->valor_un_produto }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Quantidade:</strong>
                            {{ $pedido->quantidade }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Valor Total:</strong>
                            R$ {{ $pedido->valor_total }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Data Pedido:</strong>
                            {{ date('d/m/Y H:m:s', strtotime($pedido->data_pedido)) }}
                        </p>
                    </div>
                    <div class="form-group mb-2">
                        <p class="fs-3 m-0">
                            <strong>Status:</strong>
                            @if ($pedido->status == 0)
                                Cancelado
                            @elseif ($pedido->status == 1)
                                Em Aberto
                            @else
                                Pago
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center gap-3 mt-2">
                    <div>
                        <a class="btn btn-primary" href="{{route('pedidos-index')}}">Pedidos</a>
                    </div>
                    <div>
                        <a class="btn btn-secondary" href="{{route('pedidos-edit', ['id' => $pedido->id])}}">Editar</a>
                    </div>
                    <div>
                        <a class="btn btn-dark" href="javascript:history.back()">Voltar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
@endsection