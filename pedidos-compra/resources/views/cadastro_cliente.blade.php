@extends('principal')

@section('conteudo')

<form method="post" action="{{route('create.cliente')}}">

  @csrf

  <div class="form-group">
    <label for="nome_cliente">Nome do Cliente</label>
    <input type="text" class="form-control" name="nome_cliente" placeholder="Digite seu nome completo">
  </div>

  <div class="form-group">
    <label for="cpf">CPF</label>
    <input type="text" class="form-control" name="cpf" placeholder="Digite seu CPF (somente números)">
  </div>

  <div class="form-group">
    <label for="email">E-Mail</label>
    <input type="email" class="form-control" name="email" placeholder="Digite seu E-Mail">
  </div>

  <button type="submit" class="btn btn-primary">Salvar Cliente</button>
</form>

@endsection