@extends('adminlte::page')

@section('title', 'Teste WebDev - Produtos')

@section('content_header')
    <h1>Produtos</h1>
@stop

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Adicionar</h3>
        </div>
        
        <!-- /.box-header -->

        <div class="box-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Ops!</h4>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
                
            @endif
           
            {!! Form::open(
                array(
                'route' => 'products.store',
                'method'=>'POST',
                'role'=>'form',
                'class'=>'row'
            )) !!}
            {{ csrf_field() }}
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Nome:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Ex.: Café expresso','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <strong>Valor unitário:</strong>
                        {!! Form::text('price', null, array('placeholder' => 'Ex.: 8.00','class' => 'form-control money')) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Código de barras:</strong>
                        {!! Form::text('bar_code', null, array('placeholder' => 'Ex.: 1234567891234','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <strong>Quantidade:</strong>
                        {!! Form::text('quantity', null, array('placeholder' => 'Ex.: 64','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-info back-button"
                        onclick="location.href='{{ route('products.index') }}'">Voltar
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop