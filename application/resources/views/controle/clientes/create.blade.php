@extends('layouts.controle')

@section('content')
<div class="card">
    <div class="card-header">
      Clientes / {{ (isset($cliente->id)) ? 'Editar' : 'Cadastrar' }}
    </div>
    <div class="card-body">
        @if(isset($cliente->id))
            {!! Form::model($cliente ?? null, ['route' => ['controle.clientes.update', $cliente->id]]) !!}
            @method('put')
        @else
            @method('post')
            {!! Form::model($cliente ?? null, ['route' => 'controle.clientes.store']) !!}
        @endif
            <div class="form-group">
              <label for="nome">Nome</label>
              {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome', 'aria-describedby' => "nomeHelp", 'maxlength' => 255, 'required']) !!}
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail', 'maxlength' => 255, 'required']) !!}
            </div>
            <div class="form-group">
              <label for="cpf">CPF</label>
              {!! Form::text('cpf', null, ['class' => 'form-control cpf', 'placeholder' => 'CPF', 'maxlength' => 255, 'required']) !!}
            </div>
            {{--
            <div class="form-group">
              <label for="password">Senha</label>
              {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Senha', 'maxlength' => 255]) !!}
            </div>
            <div class="form-group">
              <label for="password_confirmation">Confirmar senha</label>
              {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '', 'maxlength' => 255]) !!}
            </div>
            --}}
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('controle.clientes.index') }}" class="btn btn-default float-right">Calcelar</a>
        {!! Form::close() !!}
    </div>
  </div>
@endsection
