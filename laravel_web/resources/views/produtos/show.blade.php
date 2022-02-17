@extends('layouts.app')

@section('template_title', 'Visualizar Produto')

@section('content')
    
    <div class="card shadow">
        <div class="card-header text-center">
            <h2>Visualizar Produto</h2>
        </div>
        <div class="card-body p-5">
            <p><i class="fa fa-clock"></i> Última alteração: {{date('d/m/Y H:i:s', strtotime($produto->updated_at))}}</p>
            <legend class="font-small form-control text-center"><i class="fas fa-clipboard-list"></i> Dados do Produto</legend>
            
            <div class="row">
                <div class="col-12 col-md-6 text-center">
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>ID:</strong>
                            {{ $produto->id }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Código de Barras:</strong>
                            {{ $produto->cod_barras }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Nome:</strong>
                            {{ $produto->nome }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Valor:</strong>
                            R$ {{ $produto->valor }}
                        </p>
                    </div>
                    <div class="form-group">
                        <p class="fs-3 m-0">
                            <strong>Quantidade:</strong>
                            {{ $produto->quantidade }}
                        </p>
                    </div>
                    <div class="form-group mb-2">
                        <p class="fs-3 m-0">
                            <strong>Status:</strong>
                            {{ $produto->status == 1 ? 'Ativo' : 'Inativo' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center gap-3 mt-2">
                    <div>
                        <a class="btn btn-primary" href="{{route('produtos-index')}}">Produtos</a>
                    </div>
                    <div>
                        <a class="btn btn-secondary" href="{{route('produtos-edit', ['id' => $produto->id])}}">Editar</a>
                    </div>
                    <div>
                        <a class="btn btn-dark" href="javascript:history.back()">Voltar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
@endsection