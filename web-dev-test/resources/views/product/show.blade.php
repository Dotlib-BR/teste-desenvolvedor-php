@extends('adminlte::page')

@section('title', 'Teste WebDev - Produtos')

@section('content_header')
    <h1>Produtos</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Visualizar produto</h3>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
        <div class="col-md-12">
            <table style="width:50%">
                <tr>
                    <th>Nome:</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th>Valor unitário:</th>
                    <td>{{ 'R$ ' . number_format($product->price, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Código de barras:</th>
                    <td>{{ $product->bar_code }}</td>
                </tr>
                <tr>
                    <th>Quantidade:</th>
                    <td>{{ $product->quantity }}</td>
                </tr>
            </table><br><br>
        </div>
        <div class="col-md-12">
            <button type="button" class="btn btn-info"
                onclick="location.href='{{ route('products.index') }}'">Voltar
            </button>
            </div>
        </div>
    </div>
@stop


