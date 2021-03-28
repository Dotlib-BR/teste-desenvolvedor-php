@extends('layouts.controle')

@section('content')
<div class="card">
    <div class="card-header">
      Produtos / {{ (isset($produto->id)) ? 'Editar' : 'Cadastrar' }}
    </div>
    <div class="card-body">
        @if(isset($produto->id))
            {!! Form::model($produto ?? null, ['route' => ['controle.produtos.update', $produto->id]]) !!}
            @method('put')
        @else
            @method('post')
            {!! Form::model($produto ?? null, ['route' => 'controle.produtos.store']) !!}
        @endif
            <div class="form-group">
              <label for="nome">Nome</label>
              {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome', 'aria-describedby' => "nomeHelp", 'maxlength' => 255, 'required']) !!}
            </div>
            <div class="form-group">
              <label for="cod_barras">Código de barras</label>
              {!! Form::text('cod_barras', null, ['class' => 'form-control', 'placeholder' => 'Código de barras', 'maxlength' => 20, 'required']) !!}
            </div>
            <div class="form-group">
              <label for="valor">Valor</label>
              {!! Form::text('valor', null, ['class' => 'form-control decimal', 'placeholder' => 'Valor', 'maxlength' => 255, 'required']) !!}
            </div>

            <div class="form-group form-check">
              {!! Form::checkbox('ativo', 1, null, ['class' => 'form-check-input', 'id' => 'ativo']) !!}
              <label class="form-check-label" for="ativo">Publicar</label>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('controle.produtos.index') }}" class="btn btn-default float-right">Calcelar</a>
        {!! Form::close() !!}
    </div>
  </div>
@endsection
