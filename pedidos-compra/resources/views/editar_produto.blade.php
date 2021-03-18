@extends('principal')

@section('conteudo')

<form method="post" action="{{route('salvar.produto.editado', $produto->id)}}">

    {{ csrf_field() }}


    <div class="form-group">
        <label for="nome_cliente">Código de Barras</label>
        <input type="text" class="form-control" name="codigo_barras" value="{{$produto->codigo_barras}}">
    </div>

    <div class="form-group">
        <label for="cpf">Nome do Produto</label>
        <input type="text" class="form-control" name="nome_produto" value="{{$produto->nome_produto}}">
    </div>

    <div class="form-group">
        <label for="email">Valor Unitário</label>
        <input type="number" class="form-control" step="any" name="valor_unitario" value="{{$produto->valor_unitario}}">
    </div>


    <button type="submit" class="btn btn-primary">Atualizar Produto</button>
    <button type="reset" class="btn btn-warning">Limpar</button>
</form>

@endsection