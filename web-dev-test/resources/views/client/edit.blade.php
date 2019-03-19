@extends('adminlte::page')

@section('title', 'Teste WebDev - Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Editar</h3>
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
           
            {!! Form::model($client,
                [
                    'method' => 'PATCH',
                    'route' => ['clients.update', $client->id],
                    'class'=>'row'
                ])
            !!}
            {{ csrf_field() }}
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Nome:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Ex.: Irineu','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <strong>CPF:</strong>
                        {!! Form::text('cpf', null, array('placeholder' => 'Ex.: irineu@mail.com','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-info back-button"
                        onclick="location.href='{{ route('clients.index') }}'">Voltar
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop