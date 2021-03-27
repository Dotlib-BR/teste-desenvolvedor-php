@extends('layouts.controle')

@section('content')
<div class="card">
    <div class="card-header">
      Cupons de desconto / {{ (isset($cupom->id)) ? 'Editar' : 'Cadastrar' }}
    </div>
    <div class="card-body">
        @if(isset($cupom->id))
            {!! Form::model($cupom ?? null, ['route' => ['controle.cupom.update', $cupom->id]]) !!}
            @method('put')
        @else
            @method('post')
            {!! Form::model($cupom ?? null, ['route' => 'controle.cupom.store']) !!}
        @endif
            <div class="form-group">
              <label for="nome">Nome</label>
              {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome', 'aria-describedby' => "nomeHelp", 'maxlength' => 255, 'required']) !!}
            </div>
            <div class="form-group">
              <label for="codigo">Código</label>
              {!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder' => 'Código', 'maxlength' => 255, 'required']) !!}
            </div>
            <div class="form-group">
              <label for="valor">Valor</label>
              {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Valor', 'maxlength' => 255, 'required']) !!}
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('controle.cupom.index') }}" class="btn btn-default float-right">Calcelar</a>
        {!! Form::close() !!}
    </div>
  </div>
@endsection
