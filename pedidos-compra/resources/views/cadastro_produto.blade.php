@extends('principal')

@section('conteudo')

<form method="post" action="{{route('create.produto')}}">

  @csrf

  <div class="form-group">
    <label for="nome_cliente">Código de Barras</label>
    <input type="text" class="form-control" name="codigo_barras" placeholder="Exemplo: 7894900093049">
  </div>

  <div class="form-group">
    <label for="cpf">Nome do Produto</label>
    <input type="text" class="form-control" name="nome_produto" placeholder="Exemplo: Coca-Cola">
  </div>

  <div class="form-group">
    <label for="email">Valor Unitário</label>
    <input type="number" class="form-control" step="any" name="valor_unitario" placeholder="Exemplo: 6.00">
  </div>

  <button type="submit" class="btn btn-primary">Salvar Produto</button>
</form>

@endsection